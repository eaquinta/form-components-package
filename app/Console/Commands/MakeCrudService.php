<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeCrudService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crudService {name : The name of the request} {--subfolder= : The subfolder where the request should be created}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a custom Service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name       = ucfirst($this->argument('name'));
        $lowerName  = strtolower($name);
        $camelName  = Str::camel($name);
        $snakeName  = Str::snake($name);

        $pluralName = Str::plural($lowerName);
        $dashName   = str_replace('_','-',Str::snake($name));
        $tableName  = Str::snake(Str::pluralStudly($name));

        $subfolder  = ucfirst($this->option('subfolder'));
        $lowerSubfolder  = strtolower($subfolder);

        $namespace  = $subfolder ? '\\' . str_replace('/', '\\', $subfolder) . '\\' . $name : '';

        // ✅ Get model fields to create view
        $fullModelClass = 'App\\Models' . $namespace ;
        $fillable       = [];

        if (class_exists($fullModelClass)) {
            $model = new $fullModelClass;
            if ($model instanceof Model) {
                $fillable = $model->getFillable();
            } else {
                $this->error("Class {$fullModelClass} is not an Eloquent Model.");
                return 1;
            }
        } else {
            $this->error("Model {$fullModelClass} not found.");
            return 1;
        }
        $fields = '';
        foreach ($fillable as $field) {
            $fieldName = Str::snake($field);
            $fields .= "                    <div class=\"row\">\n";
            $fields .= "                        <div class=\"col-lg\">\n";
            $fields .= "                            <x-fc-input-text name=\"{$field}\" label=\"attributes.{$dashName}.{$fieldName}\" :required=\"false\" />\n";
            $fields .= "                        </div>\n";
            $fields .= "                    </div>\n";
        }
        $validateFields = '';
        $maxKeyLength = 0;
        foreach ($fillable as $field) {
            $keyLength = strlen("'{$field}'");
            if ($keyLength > $maxKeyLength) {
                $maxKeyLength = $keyLength;
            }
        }
        $minAlignedPosition = 28;
        $alignedPosition = max($maxKeyLength + 3, $minAlignedPosition); // +3 para ': '
        $alignedPosition = ceil($alignedPosition / 4) * 4;
        foreach ($fillable as $field) {
            $quotedField    = "'{$field}'";
            $padding        = str_repeat(' ', $alignedPosition - strlen($quotedField) - 2);
            $validateFields .= "                    {$quotedField}:{$padding}{ required: false },\n";
        }

        // Definir la ruta del archivo
        $servicePath = app_path('Services/' . ($subfolder ? "$subfolder/" : '') . "{$name}Service.php");


        // Verificar si el archivo ya existe
        if (File::exists($servicePath)) {
            $this->error("Service [{$servicePath}] already exists!"); // Mensaje idéntico al de make:request
            return; // Detener la ejecución
        }

        // Crear la carpeta si no existe
        if (!File::exists(dirname($servicePath))) {
            File::makeDirectory(dirname($servicePath), 0755, true);
        }

        // Contenido personalizado del Request
        $customContent = <<<PHP
<?php

namespace App\Services\\{$subfolder};

use DataTables;
use App\Helpers\PhpHelper;
use Illuminate\Support\Str;
use App\Models\\{$subfolder}\\{$name};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\DataTableFilterHelper;

class {$name}Service
{
    protected \${$camelName};

    public function __construct({$name} \${$camelName})
    {
        \$this->{$camelName} = \${$camelName};
    }

    public function getById(\$id)
    {
        return \$this->{$camelName}
            ->find(\$id);
    }

    public function getAll()
    {
        return \$this->{$camelName}
            ->all();
    }

    public function queryBase()
    {
        return \$this->{$camelName}
            ->query();
    }

    public function store(array \$data)
    {
        return \$this->{$camelName}
            ->create(\$data);
    }

    public function update(\$id, array \$data)
    {
        return \$this->{$camelName}
            ->find(\$id)
            ->update(\$data);
    }

    public function storeOrUpdate(array \$data)
    {
        return \$this->{$camelName}
            ->updateOrCreate(
                ['id' => \$data['id'] ?? null],
                \$data
            );
    }

    public function destroy(\$id)
    {
        return \$this->{$camelName}
            ->find(\$id)
            ->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | Custom region
    |--------------------------------------------------------------------------
    */

    public function getDatatable()
    {
        \$query = \$this->{$camelName}->query();

        \$data = Datatables::eloquent(\$query)
            ->addIndexColumn()
            ->addColumn('action', function(\$row) {
                return PhpHelper::getActionMenu(
                    \$row->id,
                    '{$dashName}'
                );
            })
            ->rawColumns(['action'])
            ->make(true);

        return \$data;
    }

    public function getExcelData(\$params)
    {
        \$query = {$name}::query();
        \$filteredQuery = DataTableFilterHelper::apply(\$query, \$params);
        \$regs = \$filteredQuery->get();
        // \$regs = \$regs->map(function (\$item) {
        //     return \$item->only([
        //         'id',
        //     ]);
        // });
        return \$regs;
    }

    public function getAuditData(\$id)
    {
        \$data = \$this->{$camelName}
            ->find(\$id)
            ->audits()
            ->with('user')
            ->get()
            ->map(function (\$audit) {
                return PhpHelper::auditLang(\$audit, 'attributes.{$dashName}');
            });
        return PhpHelper::getAudits(\$data);
    }

    public function getDeletedAuditData()
    {
        \$deletedAudits = \OwenIt\Auditing\Models\Audit::where('auditable_type', \App\Models\\{$subfolder}\\{$name}::class)
            ->where('event', 'deleted')
            ->orderBy('created_at', 'desc')
            ->limit(25)
            ->get()
            ->map(function (\$audit) {
                return \$this->auditDeleteInfo(\$audit);
            })
            ->map(function (\$audit) {
                return \App\Helpers\PhpHelper::auditLang(\$audit, 'attributes.{$dashName}');
            });
        return PhpHelper::getAudits(\$deletedAudits);
    }

    public function select()
    {
        \$regs = \$this->{$camelName}->all();
        return \$regs->map(function(\$reg) {
            return [
                'id'    => \$reg->id,
                'text'  => \$reg->name,
            ];
        });
    }

    public function getSelect2(\$term = null, \$withKey = false, \$key = null, \$withValue = false, \$value = null, \$excludeId = null)
    {
        \$regs = \$this->{$camelName}->query()
            ->when(\$term, function(\$query) use (\$term) {
                \$query->where('name', 'like', "%{\$term}%");
            })
            ->when(\$withKey, function(\$query) use (\$key) {
                \$query->where('id', \$key);
            })
            ->when(\$withValue, function(\$query) use (\$value) {
                \$query->where('name', '=', \$value);
            })
            ->when(\$excludeId, function(\$query) use (\$excludeId) {
                \$query->where('id', '!=', \$excludeId);
            })
            ->get()
            ->map(function(\$reg) {
                return [
                    'id'    => \$reg->id,
                    'text'  => \$reg->name,
                ];
            });
        return \$regs;
    }

    /*
    |--------------------------------------------------------------------------
    | Private region
    |--------------------------------------------------------------------------
    */

    private function auditDeleteInfo(\$audit)
    {
        \$oldValues  = \$audit->old_values;
        \$name       = \$oldValues['name'] ?? 'N/D';
        \$audit->information = PhpHelper::truncateWithEllipsis(\$name, 80);
        return \$audit;
    }
}
PHP;

        // Escribir el contenido personalizado en el archivo
        File::put($servicePath, $customContent);

        $this->info("Custom service created successfully at [$servicePath]");
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

class MakeShowView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:showView {name : The name of the request} {--subfolder= : The subfolder where the request should be created}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a custom view';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name       = ucfirst($this->argument('name'));
        $lowerName  = strtolower($name);

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
        $viewPath = resource_path('views/' . ($subfolder ? "$lowerSubfolder/{$dashName}/modals/" : '') . "show.blade.php");

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
            $fields .= "                            <x-fc-input-text name=\"{$field}\" label=\"attributes.{$dashName}.{$fieldName}\" :readOnly=\"true\" prefixId=\"view_\" />\n";
            $fields .= "                        </div>\n";
            $fields .= "                    </div>\n";
        }

        // Verificar si el archivo ya existe
        if (File::exists($viewPath)) {
            $this->error("View [{$viewPath}] already exists!"); // Mensaje idéntico al de make:request
            return; // Detener la ejecución
        }


        // // Crear la carpeta si no existe
        // if (!File::exists(dirname($viewPath))) {
        //     File::makeDirectory(dirname($viewPath), 0755, true);
        // }

        // Contenido personalizado del Request
        $customContent = <<<PHP
<div class="modal fade" id="view_modal" tabindex="-1" aria-labelledby="example_modal_label" data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0" style="border-bottom: none;">
                <h5 class="modal-title text-secondary" id="example_modal_label">{{ __('buttons.{$dashName}.btnView') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="view_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="view_id">
                <div class="modal-body p-3">

{$fields}

                    {{-- audit --}}
                    <div class="row mt-2">
                        <div class="col fw-400 fs-rem-80">{{__('Created at')}}: <span class="fw-600" id="view_created_at"></span></div>
                        <div class="col fw-400 fs-rem-80 text-end">{{__('Updated at')}}: <span class="fw-600" id="view_updated_at"></span></div>
                    </div>

                </div>
                <div class="modal-footer pt-0" style="border-top: none;">
                    <x-fc-button-close label="Close" icon="fas fa-times" />
                </div>
            </form>
        </div>
    </div>
</div>

@push('partialjs')
    <script>
        $(function () {
            {{-- View --}}
            $('#grid').on('click', '.view', function(e) {
                e.preventDefault();
                const id = $(this).data('model-id');

                $.ajax({
                    beforeSend: function() {
                    },
                    type: "GET",
                    dataType: "json",
                    url: `\${baseURL}/\${id}`,
                    success: function(r) {
                        if (jshelper.handleResponse(r)){
                            const data = r.data;
                            jshelper.populate.data(data, 'view_');
                            jshelper.populate.audits(data, 'view_');
                            $(`#view_modal`).modal('show');
                        }
                    },
                    error: function(xhr) {
                        jshelper.handleErrors(xhr);
                    },
                    complete: function() {
                    },
                });
            });
        });
    </script>
@endpush

PHP;

        // Escribir el contenido personalizado en el archivo
        File::put($viewPath, $customContent);

        $this->info("Custom view created successfully at [$viewPath]");
    }
}

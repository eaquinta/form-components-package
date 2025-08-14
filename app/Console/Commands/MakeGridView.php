<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

class MakeGridView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:gridView {name : The name of the request} {--subfolder= : The subfolder where the request should be created}';

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

        $columns = "";
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
        foreach ($fillable as $field) {
            $fieldName = Str::snake($field);
            $columns .= "                <th><div id=\"search_{$fieldName}\"></div><div class=\"header\">{{ __('attributes.{$dashName}.{$fieldName}') }}</div></th>\n";
        }

        $dtFilter = "";
        $cnt = 2;
        foreach ($fillable as $field) {
            $fieldName = Str::snake($field);
            $dtFilter .= "                {\n";
            $dtFilter .= "                    column_number: {$cnt},\n";
            $dtFilter .= "                    filter_type: \"none\",\n";
            $dtFilter .= "                    // filter_type: \"text\",\n";
            $dtFilter .= "                    // filter_default_label: \"{{ __('attributes.{$dashName}.{$fieldName}') }}\",\n";
            $dtFilter .= "                    // filter_container_id: \"search_{$fieldName}\"\n";
            $dtFilter .= "                },\n";
            $cnt++;
        }

        $dtColumn = "";
        $cnt = 2;
        foreach ($fillable as $field) {
            $fieldName = Str::snake($field);
            $dtColumn .= "                    { // {$cnt}\n";
            $dtColumn .= "                        class: 'align-bottom',\n";
            $dtColumn .= "                        data: '{$fieldName}',\n";
            $dtColumn .= "                        orderable: false,\n";
            $dtColumn .= "                        searchable: false,\n";
            $dtColumn .= "                        name: '{$fieldName}'\n";
            $dtColumn .= "                    },\n";
            $cnt++;
        }

        // Definir la ruta del archivo
        $viewPath = resource_path('views/' . ($subfolder ? "$lowerSubfolder/{$dashName}/partials/" : '') . "grid.blade.php");

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
@php
    \$gridId     = isset(\$gridId) ? \$gridId : 'grid';
    \$dataTable  = isset(\$dataTable) ? \$dataTable : 'dataTable';
    \$startTime  = isset(\$startTime) ? \$startTime : 'startTime'
@endphp
<div class="table-responsive" style="overflow-y: visible;">
    <table id="{{ \$gridId }}" class="table table-hover primary inverted-striped w-100" style="font-size: 0.875rem;">
        <thead>
            <tr>
                <th>{{-- EXPAND 0 --}}</th>
                <th><div class="header">{{ __('Id')}}</div></th>
{$columns}
                <th>{{ __('Action')}}</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


@push('partialjs')
    <script>
        $(function () {
            {{-- Init dataTables --}}
            const dataTableOptions = $.extend(true, {}, defaultDataTableOptions, dtLanguage, {
                ajax: {
                    url: `\${baseURL}-datatable`,
                    beforeSend: function() {
                        {{ \$startTime }} = jshelper.dtShowLoadingOverlay('#{{ \$gridId }}', {{ \$startTime }});
                    },
                    complete: function() {
                    },
                    error: function (xhr, error, code) {
                        jshelper.failure();
                    },
                },
                order: [1, 'asc'],
                columns: [
                    emptyResponsiveColumn,
                    { // 1
                        class: 'align-bottom',
                        data: 'id',
                        name: 'id'
                    },
{$dtColumn}
                    { // 5
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: "align-bottom text-center no-select",
                        width: "45px",
                        responsivePriority: 1,
                    },
                ]
            });

            {{-- Initialize dataTable --}}
            {{ \$dataTable }} = $('#{{ \$gridId }}').DataTable(dataTableOptions)
                .on('preDraw', function() {
                    {{ \$startTime }} = jshelper.dtShowLoadingOverlay('#{{ \$gridId }}', {{ \$startTime }});
                }).on('draw', function() {
                    {{ \$startTime }} = jshelper.dtHideLoadingOverlay('#{{ \$gridId }}', {{ \$startTime }});
                });

            {{-- Initialize YADCF --}}
            yadcf.init({{ \$dataTable }}, [
                {
                    column_number: 0,
                    filter_type: "none"
                },
                {
                    column_number: 1,
                    filter_type: "none"
                },
{$dtFilter}
            ]);

            $(window).resize(function() {
                adjustPagination();
            });

            jshelper.dtShowClearFilters('{{ \$gridId }}', {{ \$dataTable }});
        });
    </script>
@endpush
PHP;

        // Escribir el contenido personalizado en el archivo
        File::put($viewPath, $customContent);

        $this->info("Custom view created successfully at [$viewPath]");
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeCrudView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crudView {name : The name of the request} {--subfolder= : The subfolder where the request should be created}';

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
        $routeName  = Str::snake(Str::plural($name), '-');

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
        $viewPath = resource_path('views/' . ($subfolder ? "$lowerSubfolder/{$dashName}/" : '') . "crud-" . Str::snake($name, '-') . ".blade.php");

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
@extends('layouts.app')

@section('title', \$title)

@section('content')
    @include('{$lowerSubfolder}.{$dashName}.modals.show')
    @include('{$lowerSubfolder}.{$dashName}.modals.create')
    @include('{$lowerSubfolder}.{$dashName}.modals.edit')
    @include('common._audit')
    @include('common._audit-deleted')

    <div class="container-fluid">
        @include('components.breadcrumb', ['breadcrumbs' => \$breadcrumbs])

        @component('components.index-card', [
            'title'     => \$title,
            'subtitle'  => \$subtitle,
        ])

            @slot('actions')
                @can('application.{$dashName}.create')
                    <button class="btn btn-outline-primary rounded-2" id="create_btn" title="{{ __('Create') }}"><i class="fas fa-plus me-sm-2"></i><div class="d-none d-sm-inline">{{ __('buttons.{$dashName}.btnCreate') }}</div></button>
                @endcan
                @can('application.{$dashName}.excel')
                    <button class="btn btn-outline-success rounded-2" id="excel_btn" title="{{ __('Excel') }}"><i class="far fa-file-excel me-sm-2"></i><div class="d-none d-sm-inline">{{ __('Excel') }}</div></button>
                @endcan
                <button class="btn btn-outline-danger rounded-2" id="sync_btn" title="{{ __('Sincronizar') }}"><i class="fas fa-sync-alt"></i><div class="d-none d-sm-inline"></div></button>
                @can('application.{$dashName}.audit')
                    <button class="btn btn-outline-danger rounded-2" id="btn-deleted-audits" title="{{ __('Deleted Audit') }}"><i class="fas fa-trash-restore"></i></button>
                @endcan
                {{-- @can('application.model.audit')
                    <button class="btn btn-outline-danger rounded-2" id="btn-deleted-audits" title="{{ __('Deleted Audit') }}"><i class="fas fa-trash-restore"></i></button>
                @endcan --}}
            @endslot
            @include('{$lowerSubfolder}.{$dashName}.partials.grid')
        @endcomponent
    </div>
@endsection


@section('styles')
    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('vendor/DataTables/DataTables-1.13.7/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/DataTables/Responsive-2.5.0/css/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/DataTables/Select-1.6.1/css/select.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('custom/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/datatables/datatables-dark.css') }}">
    {{-- YADCF --}}
    <link rel="stylesheet" href="{{ asset('vendor/yadcf-0.9.6/jquery.dataTables.yadcf.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/yadcf/yadcf.css') }}">
    <!-- Croppie css -->
    <link rel="stylesheet" href="{{ asset('vendor/croppie-2.6.2/croppie.min.css') }}"/>
@endsection

@section('scripts')
    {{-- DataTables --}}
    <script src="{{ asset('vendor/DataTables/DataTables-1.13.7/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/DataTables/DataTables-1.13.7/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/DataTables/Responsive-2.5.0/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/DataTables/Responsive-2.5.0/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/DataTables/Select-1.6.1/js/dataTables.select.min.js')}}"></script>
    <script src="{{ asset('custom/datatables/datatables.js') }}"></script>
    {{-- YADCF --}}
    <script src="{{ asset('vendor/yadcf-0.9.6/jquery.dataTables.yadcf.js') }}"></script>

    <script>
        let dataTable;
        let startTime = null;

        {{-- fetch dataTable --}}
        function fetchGrid() {
            dataTable.ajax.reload();
        }

        $(function() {
            {{-- Sync --}}
            $(document).on('click', '#sync_btn', function (e) {
                e.preventDefault();
                fetchGrid();
            });

            {{-- Excel --}}
            $('#excel_btn').on('click', function() {
                const parameterData = jshelper.getDataTableParameters(null, dataTable);
                const queryString = $.param(parameterData);
                window.location.href = `\${baseURL}-excel?\${queryString}`;
            });

            {{-- Delete --}}
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                const id = $(this).data('model-id');
                jshelper.deleteConfirm(function() {
                    $.ajax({
                        beforeSend: function() {
                            $(this).addClass('disabled');
                        },
                        url: `\${baseURL}/\${id}`,
                        method: 'DELETE',
                        dataType: "json",
                        success: function(r) {
                            if(jshelper.handleResponse(r)) {
                                fetchGrid();
                            }
                        },
                        error: function(xhr) {
                            jshelper.handleErrors(xhr);
                        },
                        complete: function() {
                            $(this).removeClass('disabled');
                        },
                    });
                });
            });

            {{-- Audits --}}
            jshelper.crudShowAudits('#grid', { baseURL: baseURL });

            {{-- Audits deleted --}}
            jshelper.crudShowDeletedAudits('#btn-deleted-audits', { url: '{{ route("{$routeName}.deleted-audits") }}' });

            {{-- Help --}}
            helps = (typeof helps !== 'undefined') ? helps : [];
            jshelper.crudShowHelps(helps, '{{ route('user-manuals.get-menu-options') }}', '{{ route('user-manuals.get-file')}}');

        });
    </script>
    @stack('partialjs')
@endsection
PHP;

        // Escribir el contenido personalizado en el archivo
        File::put($viewPath, $customContent);

        $this->info("Custom request created successfully at [$viewPath]");
    }
}

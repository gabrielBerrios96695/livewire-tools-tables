<?php

namespace GabrielBerrios\LivewireToolsTable\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Filesystem\Filesystem;

class MakeTableCommand extends Command
{
    protected $signature = 'livewire-tools:table {--model= : Nombre del modelo}';
    protected $description = 'Crea un componente Livewire Table con columnas dinámicas basadas en un modelo';

    public function handle()
    {
        $model = $this->option('model');

        if (!$model) {
            $this->error('Debes especificar un modelo con --model=User');
            return 1;
        }

        $modelClass = "App\\Models\\$model";
        if (!class_exists($modelClass)) {
            $this->error("El modelo $modelClass no existe.");
            return 1;
        }

        $componentName = Str::camel($model) . 'Table';
        $componentClassName = Str::studly($componentName);
        $componentPath = app_path("Livewire/{$componentClassName}.php");

        if ((new Filesystem)->exists($componentPath)) {
            $this->error("El componente {$componentClassName} ya existe en {$componentPath}.");
            return 1;
        }

        $modelInstance = new $modelClass;
        $table = $modelInstance->getTable();
        $columns = Schema::getColumnListing($table);

        $columnsArray = array_map(fn ($col) => "            Column::make('{$col}')", $columns);
        $columnsString = implode(",\n", $columnsArray);

        $componentTemplate = <<<PHP
<?php

namespace App\\Livewire;

use GabrielBerrios\\LivewireToolsTable\\Http\\Livewire\\LivewireToolsTable;
use GabrielBerrios\\LivewireToolsTable\\Columns\\Column;
use Illuminate\\Database\\Eloquent\\Builder;
use App\\Models\\{$model};

class {$componentClassName} extends LivewireToolsTable
{
    // public string \$title = '{$model}s'; // Opcional: Título de la tabla

    public function columns(): array
    {
        return [
$columnsString
        ];
    }

    public function query(): Builder
    {
        return {$model}::query();
    }
}

PHP;

        (new Filesystem)->put($componentPath, $componentTemplate);

        $this->info("✅ Componente {$componentClassName} creado en {$componentPath} con columnas dinámicas de '{$modelClass}'.");
        $this->info("👉 Para usarlo, agrega en tu Blade: <livewire:{$componentName} />");

        return 0;
    }
}

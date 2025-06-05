<?php

namespace GabrielBerrios\LivewireToolsTable\Providers;

use Illuminate\Support\ServiceProvider;
use GabrielBerrios\LivewireToolsTable\Commands\MakeTableCommand;

class LivewireToolsTableServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Puedes registrar bindings o configuraciones adicionales aquí si lo necesitas.
    }

    public function boot()
    {
        // Publica la configuración
        $this->publishes([
            __DIR__ . '/../../config/livewire-tools-table.php' => config_path('livewire-tools-table.php'),
        ], 'config');

        // Registra el comando Artisan y muestra el mensaje post-instalación
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeTableCommand::class,
            ]);

            $this->displayInstallationMessage();
        }

        // Registra las vistas para que Livewire pueda usarlas
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'livewire-tools-table');

        // Opcional: registrar componentes Livewire específicos (si es necesario)
        // Livewire::component('livewire-tools-table.search-input', SearchInput::class);
    }

    protected function displayInstallationMessage(): void
    {
        // Verifica que se ejecute desde la consola y que el comando sea install o update de Composer
        if (isset($_SERVER['argv']) && $this->isComposerInstallOrUpdate($_SERVER['argv'])) {
            $this->app->terminating(function () {
                $message = [
                    '',
                    '🎉 ¡Livewire Tools Table instalado correctamente!',
                    '',
                    '👉 Para generar un componente de tabla, ejecuta:',
                    '   php artisan livewire-tools:table {--model= : Nombre del modelo}',
                    '',
                    '📄 Documentación y más información:',
                    '   https://github.com/GabrielBerrios/livewire-tools-table',
                    '',
                ];

                $this->app['console']->info(implode(PHP_EOL, $message));
            });
        }
    }

    protected function isComposerInstallOrUpdate(array $argv): bool
    {
        return collect($argv)
            ->intersect(['install', 'update', 'require'])
            ->isNotEmpty();
    }
}

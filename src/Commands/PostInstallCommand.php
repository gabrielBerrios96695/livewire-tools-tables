<?php

namespace GabrielBerrios\LivewireToolsTable\Commands;

use Illuminate\Console\Command;

class PostInstallCommand extends Command
{
    protected $signature = 'livewire-tools-table:post-install';
    protected $description = 'Muestra mensaje post-instalación de Livewire Tools Table';

    public function handle()
    {
        $this->info('');
        $this->info('🎉 ¡Livewire Tools Table instalado correctamente!');
        $this->info('');
        $this->info('👉 Para generar un componente de tabla, ejecuta:');
        $this->info('   php artisan make:livewire-table NombreDeLaTabla');
        $this->info('');
        $this->info('📄 Documentación y más información:');
        $this->info('   https://github.com/GabrielBerrios/livewire-tools-table');
        $this->info('');
    }
}

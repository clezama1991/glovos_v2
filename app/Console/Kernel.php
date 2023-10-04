<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
 
    protected $commands = [
        Commands\SincronizacionWoocommercesCron::class,
        Commands\ClearFilesMultimediasExpiredCron::class,
        Commands\UpdatePedidosReembolsoCron::class,
    ];
 
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    { 
        $schedule->command('sincronizacion:woocommerce')
                 ->everyMinute();
                 
        $schedule->command('clearfiles:multimediascaducados')
                 ->daily();

        $schedule->command('updatepedidos:reembolsoCron')
                 ->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

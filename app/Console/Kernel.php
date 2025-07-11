<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\SendIGDData::class,
        \App\Console\Commands\SendKunjRalan::class,
        \App\Console\Commands\SendBPJSNonBPJS::class,
        \App\Console\Commands\SendResepFarmasi::class,
        \App\Console\Commands\SendRadiologi::class,
        \App\Console\Commands\SendLabSampel::class,
        \App\Console\Commands\SendLabParameter::class,
        \App\Console\Commands\SendOperasi::class,
        \App\Console\Commands\SendRalan::class,
        \App\Console\Commands\SendRanap::class,
       
    ];
  
    protected function schedule(Schedule $schedule)
    {
        // Schedule Layanan
        $schedule->command('igd:send')->dailyAt('23:59');
        $schedule->command('kunjralan:send')->dailyAt('23:00');
        $schedule->command('bpjsnonbpjs:send')->dailyAt('23:00');
        $schedule->command('radiologi:send')->dailyAt('23:59');
        $schedule->command('resep:send')->dailyAt('23:59');
        $schedule->command('labsampel:send')->dailyAt('23:59');
        $schedule->command('labparam:send')->dailyAt('23:59');
        $schedule->command('operasi:send')->dailyAt('15:00');
        $schedule->command('ralan:send')->dailyAt('22:59');
        $schedule->command('ranap:send')->dailyAt('23:59');

        // Schedule IKT
        // $schedule->command('visite10:send')->dailyAt('23:59');
        // $schedule->command('visite10-12:send')->dailyAt('23:59');
        // $schedule->command('visite12:send')->dailyAt('23:59');
        // $schedule->command('dpjpnonvisite:send')->dailyAt('23:59');
        // $schedule->command('visitepertama:send')->dailyAt('23:59');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

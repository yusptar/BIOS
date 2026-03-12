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
        // Schedule Keuangan

        // Schedule Layanan
        $schedule->command('igd:send')->dailyAt('00:03');
        $schedule->command('kunjralan:send')->dailyAt('00:04');
        $schedule->command('bpjsnonbpjs:send')->dailyAt('00:05');
        $schedule->command('radiologi:send')->dailyAt('00:06');
        $schedule->command('resep:send')->dailyAt('00:07');
        $schedule->command('labsampel:send')->dailyAt('00:08');
        $schedule->command('labparam:send')->dailyAt('00:09');
        $schedule->command('operasi:send')->dailyAt('00:10');
        $schedule->command('ralan:send')->dailyAt('00:12');
        $schedule->command('ranap:send')->dailyAt('00:14');
        $schedule->command('bor:send')->monthlyOn(1, '00:01'); 
        $schedule->command('toi:send')->monthlyOn(1, '00:01'); 
        $schedule->command('alos:send')->monthlyOn(1, '00:02'); 
        $schedule->command('bto:send')->monthlyOn(1, '00:02');
        
        // Schedule IKT
        
        // Schedule SIMANIS
        $schedule->command('ralansimanis:send')->dailyAt('00:03');
        $schedule->command('ranapsimanis:send')->dailyAt('00:04');

    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

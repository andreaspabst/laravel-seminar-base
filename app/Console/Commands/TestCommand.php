<?php

namespace App\Console\Commands;

use App\House;
use App\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use App\Exceptions\TooLessMoneyForBuyingAHouseException;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ap:test';  // php artisan ap:test

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Hallo, hier wird logging getestet');
        Log::info('Hi');
        Log::critical('Echt wichtig!');
    }
}

<?php

namespace App\Console\Commands;

use App\House;
use App\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ap:test';

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
        $a = "einen text";
        $aCrypt = "eyJpdiI6IjlsMlRNM2hkbjR5OEdCdTFBNHRnRGc9PSIsInZhbHVlIjoiSHNVaFVpY0UrakczYytFcEo0NndqR1RNdnpYSlAyR3NrUUtoWGlDTGE1ND0iLCJtYWMiOiIwYzMyMTY1NTMxMTE4ZDcwNzRkMDhjYzUwZDNmNGRiNDQyMThmY2MzZmZjMzZhYmE0NDU5ODk5NmFhYTg5ODhiIn0=";

        $this->line(Crypt::decrypt($aCrypt));
        exit;
        DB::enableQueryLog();
        $houses = Country::with('houses')->get();
        dd(DB::getQueryLog());
    }
}

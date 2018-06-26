<?php

namespace App\Console\Commands\Price;

use App\Tasks\Price;
use Illuminate\Console\Command;

class CurrencyPriceClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoupbit:price:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean and leave 30 days of records';

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
        $priceTasker = new Price();
        $priceTasker->cleanUp(30);
    }
}

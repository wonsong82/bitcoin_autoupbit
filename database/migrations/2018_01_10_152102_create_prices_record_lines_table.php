<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesRecordLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices_record_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prices_record_id')->unsigned();
            $table->foreign('prices_record_id')
                ->references('id')->on('prices_records')->onDelete('cascade');

            $table->integer('currency_id')->unsigned();
            $table->foreign('currency_id')
                ->references('id')->on('currencies')->onDelete('cascade');

            $table->double('base_price', 20, 8);
            $table->double('premium_price', 20, 8);
            $table->double('premium_amount', 20, 8);
            $table->double('premium_rate', 5, 4);

            // Standard Deviations (5min, 10min, 30min, 60min, 120min 240min)
            // base price
            $table->double('sd_bp_5', 5, 4)->nullable();
            $table->double('sd_bp_10', 5, 4)->nullable();
            $table->double('sd_bp_30', 5, 4)->nullable();
            $table->double('sd_bp_60', 5, 4)->nullable();
            $table->double('sd_bp_120', 5, 4)->nullable();
            $table->double('sd_bp_240', 5, 4)->nullable();

            // premium price
            $table->double('sd_pp_5', 5, 4)->nullable();
            $table->double('sd_pp_10', 5, 4)->nullable();
            $table->double('sd_pp_30', 5, 4)->nullable();
            $table->double('sd_pp_60', 5, 4)->nullable();
            $table->double('sd_pp_120', 5, 4)->nullable();
            $table->double('sd_pp_240', 5, 4)->nullable();

            // primium rate
            $table->double('sd_pr_5', 5, 4)->nullable();
            $table->double('sd_pr_10', 5, 4)->nullable();
            $table->double('sd_pr_30', 5, 4)->nullable();
            $table->double('sd_pr_60', 5, 4)->nullable();
            $table->double('sd_pr_120', 5, 4)->nullable();
            $table->double('sd_pr_240', 5, 4)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices_record_lines');
    }
}

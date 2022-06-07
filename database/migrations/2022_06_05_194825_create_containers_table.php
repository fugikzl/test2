<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->integer("LocationId");
            $table->integer("BlockNum");
            $table->integer("RentedBlockNum");
            $table->integer("temperature");
        });

        DB::table('containers')->insert([
            "LocationId"=>1,
            "BlockNum"=>30,
            "RentedBlockNum"=>22,
            "temperature"=>17,
        ]);
        DB::table('containers')->insert([
            "LocationId"=>1,
            "BlockNum"=>10,
            "RentedBlockNum"=>8,
            "temperature"=>30,
        ]);
        DB::table('containers')->insert([
            "LocationId"=>1,
            "BlockNum"=>50,
            "RentedBlockNum"=>23,
            "temperature"=>20,
        ]);
        DB::table('containers')->insert([
            "LocationId"=>1,
            "BlockNum"=>50,
            "RentedBlockNum"=>13,
            "temperature"=>8,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('containers');
    }
};

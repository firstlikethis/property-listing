<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bts_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('line')->nullable(); // สายรถไฟฟ้า เช่น BTS, MRT, Airport Link
            $table->string('color')->nullable(); // สีของสาย
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bts_stations');
    }
};

<?php

use App\Enums\Days;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('days', [Days::Sunday, Days::Monday, Days::Tuesday, Days::Wednesday, Days::Thursday, Days::Friday, Days::Saturday])->default(Days::Sunday);
            $table->integer('min_nights');
            $table->integer('max_nights');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_packages');
    }
}

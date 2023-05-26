<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar_informasis', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->foreignId('user_id');
            $table->foreignId('informasi_id');
            $table->foreignId('komentar_informasi_id')->nullable();
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
        Schema::dropIfExists('komentar_informasis');
    }
};

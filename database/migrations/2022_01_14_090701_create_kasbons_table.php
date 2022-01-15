<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasbonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasbon', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_diajukan');
            $table->date('tanggal_disetujui')->nullable();
            $table->foreignId('pegawai_id')->constrained('pegawai')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('total_kasbon');
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
        Schema::dropIfExists('kasbon');
    }
}

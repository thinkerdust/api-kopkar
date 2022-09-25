<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->char('nik', 8)->unique();
            $table->string('nama');
            $table->integer('grade')->default(0);
            $table->string('dept');
            $table->boolean('status')->default(0);
            $table->date('tgl_masuk');
            $table->integer('s_sukarela')->default(0);
            $table->string('no_rek', 20)->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->date('tgl_resign')->nullable();
            $table->integer('s_pokok')->default(0);
            $table->integer('s_wajib')->default(0);
            $table->integer('p_wajib')->default(0);
            $table->integer('p_sukarela')->default(0);
            $table->boolean('flag_out')->default(0);
            $table->boolean('flag_ambil')->default(0);
            $table->integer('plafond')->default(0);
            $table->integer('sisa_plafond')->default(0);
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
            $table->index('nik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}

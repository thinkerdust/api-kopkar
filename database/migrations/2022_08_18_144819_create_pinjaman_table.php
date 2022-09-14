<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->char('nik', 8);
            $table->char('kode_pjmn', 3);
            $table->date('tanggal');
            $table->char('nota', 7);
            $table->integer('s_pokok')->default(0);
            $table->integer('tot_angsuran')->default(0);
            $table->integer('tot_cicilan')->default(0);
            $table->integer('jml_cicilan')->default(0);
            $table->boolean('proses')->default(0);
            $table->integer('angsuran')->default(0);
            $table->boolean('flag')->default(0);
            $table->integer('bunga')->default(0);
            $table->text('note')->nullable();
            $table->date('tgl_lunas')->nullable();
            $table->integer('pelunasan')->default(0);
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
            $table->index(['kode_pjmn', 'nik', 'nota']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjaman');
    }
}

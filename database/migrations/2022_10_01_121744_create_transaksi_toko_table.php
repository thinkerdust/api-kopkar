<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTokoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_toko', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('kode_trx')->comment('2: penjualan; 4: retur penjualan (merah)');
            $table->char('nik', 8);
            $table->char('nota', 7);
            $table->date('tanggal');
            $table->tinyInteger('flag_bayar')->comment('1: kredit; 2: cash');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('nominal')->default(0);
            $table->boolean('proses')->default(1);
            $table->date('tgl_lunas')->nullable();
            $table->integer('angsuran')->default(0);
            $table->tinyInteger('cicilan')->default(1);
            $table->double('bunga', 8, 2)->default(0);
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
            $table->index(['kode_trx', 'nik', 'nota', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_toko');
    }
}

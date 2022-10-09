<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTokoDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_toko_detail', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('kode_trx');
            $table->char('nota', 7);
            $table->char('kode_brg', 6);
            $table->integer('qty')->default(0);
            $table->double('diskon', 8, 2)->default(0);
            $table->integer('harga')->default(0);
            $table->double('average', 8, 2)->default(0);
            $table->integer('harga_diskon')->default(0);
            $table->char('unit', 5);
            $table->integer('total')->comment('bersih');
            $table->char('kode_ktgri', 3);
            $table->char('nik', 8);
            $table->date('tgl_exp')->nullable();
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
            $table->index(['kode_trx', 'nik', 'nota', 'kode_brg']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_toko_detail');
    }
}

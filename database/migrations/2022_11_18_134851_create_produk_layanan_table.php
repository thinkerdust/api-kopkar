<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_layanan', function (Blueprint $table) {
            $table->id();
            $table->char('kode',2);
            $table->char('nik', 8);
            $table->char('nokon', 25);
            $table->string('nama');
            $table->text('note')->nullable();
            $table->integer('jumlah')->default(0);
            $table->integer('jumlah_k')->default(0);
            $table->integer('kali_n')->default(0)->comment('Rencana dilakukan brp x');
            $table->integer('kali_x')->default(0)->comment('Sudah dilakukan brp x');
            $table->boolean('proses')->default(1)->comment('1:proses');
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
            $table->index(['kode', 'nik', 'nokon']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_layanan');
    }
}

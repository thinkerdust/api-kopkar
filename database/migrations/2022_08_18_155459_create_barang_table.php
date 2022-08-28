<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('barcode')->nullable();
            $table->string('nama');
            $table->string('unit_k', 5)->nullable();
            $table->string('unit_b', 5)->nullable();
            $table->integer('konversi')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('beli')->default(0);
            $table->integer('jual')->default(0);
            $table->boolean('group')->default(0)->comment('1:indofood');
            $table->char('kode_ktgori', 3);
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
            $table->index(['kode', 'kode_ktgori']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}

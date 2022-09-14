<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxSimpananSukarelaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_simpanan_sukarela', function (Blueprint $table) {
            $table->id();
            $table->char('nik', 8);
            $table->date('tanggal');
            $table->boolean('tipe')->default(0);
            $table->text('note')->nullable();
            $table->integer('jumlah')->default(0)->nullable();
            $table->integer('bunga')->default(0)->nullable();
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
            $table->index(['tipe', 'nik', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_simpanan_sukarela');
    }
}

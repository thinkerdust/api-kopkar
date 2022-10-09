<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabungan', function (Blueprint $table) {
            $table->id();
            $table->char('jenis', 5);
            $table->char('no_acc', 10);
            $table->char('nik', 8);
            $table->string('nama');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->boolean('status')->default(0);
            $table->double('bunga', 8, 2)->default(0);
            $table->integer('saldo')->default(0);
            $table->integer('potong')->default(0);
            $table->boolean('flag_potong')->default(0);
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
            $table->index(['jenis', 'nik', 'no_acc']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabungan');
    }
}

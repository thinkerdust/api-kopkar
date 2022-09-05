<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabunganDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabungan_detail', function (Blueprint $table) {
            $table->id();
            $table->char('no_acc', 10);
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('sandi', 3);
            $table->integer('jumlah')->default(0);
            $table->double('bunga', 8, 2)->default(0);
            $table->char('flag', 2);
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabungan_detail');
    }
}

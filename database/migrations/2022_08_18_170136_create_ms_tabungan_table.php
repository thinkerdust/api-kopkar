<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsTabunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_tabungan', function (Blueprint $table) {
            $table->id();
            $table->char('jenis', 1);
            $table->string('nama');
            $table->char('kode', 3)->nullable();
            $table->char('created_by', 8)->nullable();
            $table->char('updated_by', 8)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->softDeletes($column = 'deleted_at')->nullable();
            $table->index(['jenis']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_tabungan');
    }
}

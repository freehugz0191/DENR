<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestRelDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_rel_docs', function (Blueprint $table) {
            $table->id();
            $table->string('reldoc_id');
            $table->string('tran_id');
            $table->string('status_id');
            $table->string('requser_id');
            $table->string('remarks');
            $table->string('appuser_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_rel_docs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivedDocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_docs', function (Blueprint $table) {
            $table->id();
            $table->string('doc_id');
            $table->string('tran_id')->nullable();
            $table->string('status');
            $table->string('dept_id');
            $table->string('user_id');
            $table->string('file')->nullable();
            $table->string('remarks');
            $table->string('sender');
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
        Schema::dropIfExists('received_docs');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_questions_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->longText('content');
            $table->timestamps();
            $table->foreign('product_questions_id')->references('id')->on('product_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_replies');
    }
};

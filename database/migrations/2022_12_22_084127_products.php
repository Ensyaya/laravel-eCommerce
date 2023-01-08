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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('status', ['active', 'passive'])->default('passive');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->string('image');
            $table->string('image_id')->nullable();
            $table->string('image2')->nullable();
            $table->string('image_id2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image_id3')->nullable();
            $table->integer('quantity')->default(0);
            $table->float('price')->nullable();
            $table->float('discounted_price')->nullable();
            $table->integer('discount_rate')->nullable();
            $table->timestamp('discount_finished_at')->nullable();
            $table->timestamps();
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};

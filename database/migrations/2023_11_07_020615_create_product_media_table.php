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
        Schema::create('product_media', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('product_id')->index('product_media_product_id_FK');
            $table->string('type', 64);
            $table->string('url', 512);
            $table->string('status', 20)->nullable();
            $table->timestamps();
            $table->foreign('product_id', 'product_media_product_id_FK')->references('id')->on('products')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_media');
    }
};

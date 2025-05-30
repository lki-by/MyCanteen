<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('charts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("transaksi_id");
            $table->foreignId("menu_id");
            $table->foreignId("user_id");
            $table->string("quantity");
            $table->integer("total");
            $table->timestamps();
            $table->foreign('menu_id')->references('id')->on('Menus');
            $table->foreign('user_id')->references('id')->on('Users');
            $table->foreign('transaksi_id')->references('id')->on('Transaksis');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charts');
    }
};

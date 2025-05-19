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
        Schema::table('topics', function (Blueprint $table) {
            //
            $table->string('color')->default('bg-darkPrimary')->change();
            $table->string('icon')->default('Law')->change();
            $table->integer('order')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->string('color')->default(null)->change();
            $table->string('icon')->default(null)->change();
            $table->integer('order')->default(null)->change();
        });
    }
};

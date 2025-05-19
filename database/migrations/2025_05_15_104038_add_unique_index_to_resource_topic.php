<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void    {
        Schema::table('resource_topic', function (Blueprint $table) {
            //
            $table->unique(['resource_id', 'topic_id'], 'resource_topic_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void  {
        Schema::table('resource_topic', function (Blueprint $table) {
            //
            $table->dropUnique('resource_topic_unique');
        });
    }
};

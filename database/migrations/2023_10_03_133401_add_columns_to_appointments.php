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
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['end', 'user_id']);
            $table->integer('duration');
            $table->unsignedBigInteger('joboffer_id')->nullable();
            $table->boolean('online');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->time('end');
            $table->integer('user_id');
            $table->dropColumn('joboffer_id');
            $table->dropColumn('online');
        });
    }
};

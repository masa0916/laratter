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
        Schema::table('tweets', function (Blueprint $table) {
        $table->foreignId('retweet_id')
                ->nullable()
                ->constrained('tweets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tweets', function (Blueprint $table) {
             $table->dropForeign(['retweet_id']);
            $table->dropColumn('retweet_id');
        });
    }
};

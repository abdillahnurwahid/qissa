<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_requests', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('content');
            $table->integer('duration')->nullable()->after('video_url'); 
        });
    }

    public function down(): void
    {
        Schema::table('content_requests', function (Blueprint $table) {
            $table->dropColumn(['video_url', 'duration']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_requests', function (Blueprint $table) {
            $table->longText('content')->nullable()->after('description');
            $table->foreignId('category_id')->nullable()->after('type');
            $table->bigInteger('created_content_id')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('content_requests', function (Blueprint $table) {
            $table->dropColumn(['content', 'category_id', 'created_content_id']);
        });
    }
};


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
        Schema::table('tags', function (Blueprint $table) {
            $table->boolean('is_private')->default(false)->comment('是否私有')->after('tag_name');
            $table->unsignedInteger('used_count')->default(0)->comment('使用次數')->after('is_private');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('used_count');
            $table->dropColumn('is_private');
        });
    }
};

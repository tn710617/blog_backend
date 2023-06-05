<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_post_title_post_content_fulltext_index');
            DB::statement("CREATE FULLTEXT INDEX posts_post_title_post_content_en_fulltext_index ON posts (post_title, post_content)");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            DB::statement("CREATE FULLTEXT INDEX posts_post_title_post_content_fulltext_index ON posts (post_title, post_content) WITH PARSER ngram");
            $table->dropIndex('posts_post_title_post_content_en_fulltext_index');
        });
    }
};

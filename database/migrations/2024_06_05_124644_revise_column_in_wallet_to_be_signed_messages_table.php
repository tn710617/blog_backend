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
        Schema::table('wallet_to_be_signed_messages', function (Blueprint $table) {
            $table->text('to_be_signed_message')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallet_to_be_signed_messages', function (Blueprint $table) {
            $table->string('to_be_signed_message')->change();
        });
    }
};

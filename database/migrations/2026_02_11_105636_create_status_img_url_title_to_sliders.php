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
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('title')->after('img_id')->nullable();
            $table->string('redirect_url')->after('img_id')->nullable();
            $table->enum('status',['publish','disable'])->default('publish')->after('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('redirect_url');
            $table->dropColumn('status');
        });
    }
};

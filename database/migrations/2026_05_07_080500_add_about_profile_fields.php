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
        Schema::table('abouts', function (Blueprint $table) {
            if (! Schema::hasColumn('abouts', 'birthday')) {
                $table->string('birthday')->nullable()->after('language');
            }
            if (! Schema::hasColumn('abouts', 'location')) {
                $table->string('location')->nullable()->after('birthday');
            }
            if (! Schema::hasColumn('abouts', 'freelance_status')) {
                $table->string('freelance_status')->nullable()->after('location');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            if (Schema::hasColumn('abouts', 'freelance_status')) {
                $table->dropColumn('freelance_status');
            }
            if (Schema::hasColumn('abouts', 'location')) {
                $table->dropColumn('location');
            }
            if (Schema::hasColumn('abouts', 'birthday')) {
                $table->dropColumn('birthday');
            }
        });
    }
};
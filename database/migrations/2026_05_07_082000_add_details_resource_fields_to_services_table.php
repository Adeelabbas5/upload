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
        Schema::table('services', function (Blueprint $table) {
            if (! Schema::hasColumn('services', 'details')) {
                $table->text('details')->nullable()->after('description');
            }
            if (! Schema::hasColumn('services', 'resource_link')) {
                $table->string('resource_link')->nullable()->after('details');
            }
            if (! Schema::hasColumn('services', 'resource_path')) {
                $table->string('resource_path')->nullable()->after('resource_link');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'resource_path')) {
                $table->dropColumn('resource_path');
            }
            if (Schema::hasColumn('services', 'resource_link')) {
                $table->dropColumn('resource_link');
            }
            if (Schema::hasColumn('services', 'details')) {
                $table->dropColumn('details');
            }
        });
    }
};
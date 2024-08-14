<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            // Add columns if they don't already exist
            if (!Schema::hasColumn('job_applications', 'cover_letter')) {
                $table->string('cover_letter')->nullable();
            }
            if (!Schema::hasColumn('job_applications', 'resume')) {
                $table->string('resume')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            // Drop columns if they exist
            if (Schema::hasColumn('job_applications', 'cover_letter')) {
                $table->dropColumn('cover_letter');
            }
            if (Schema::hasColumn('job_applications', 'resume')) {
                $table->dropColumn('resume');
            }
        });
    }
};

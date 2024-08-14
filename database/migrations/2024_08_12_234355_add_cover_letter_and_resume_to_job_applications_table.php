<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            // Add column only if it does not already exist
            if (!Schema::hasColumn('job_applications', 'cover_letter')) {
                $table->string('cover_letter')->nullable(); // Store path to the cover letter file
            }

            if (!Schema::hasColumn('job_applications', 'resume')) {
                $table->string('resume')->nullable(); // Store path to the resume file
            }
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            // Drop column only if it exists
            if (Schema::hasColumn('job_applications', 'cover_letter')) {
                $table->dropColumn('cover_letter');
            }

            if (Schema::hasColumn('job_applications', 'resume')) {
                $table->dropColumn('resume');
            }
        });
    }
};

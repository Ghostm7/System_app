<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUserIdToAlumniProfileIdInPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            // Rename the user_id column to alumni_profile_id
            $table->renameColumn('user_id', 'alumni_profile_id');

            // Add foreign key constraint
            $table->foreign('alumni_profile_id')->references('id')->on('alumni_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['alumni_profile_id']);

            // Rename the column back to user_id
            $table->renameColumn('alumni_profile_id', 'user_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            // Add new columns if needed
            $table->text('basic_information')->nullable()->after('alumni_profile_id');
            $table->text('education')->nullable()->after('basic_information');
            $table->text('work_experience')->nullable()->after('education');
            $table->text('skills')->nullable()->after('work_experience');
            $table->text('personal_projects')->nullable()->after('skills');
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
            // Remove columns if needed
            $table->dropColumn('basic_information');
            $table->dropColumn('education');
            $table->dropColumn('work_experience');
            $table->dropColumn('skills');
            $table->dropColumn('personal_projects');
        });
    }
}

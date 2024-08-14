<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlumniProfileIdToPortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->foreignId('alumni_profile_id')->nullable()->constrained('alumni_profiles')->onDelete('set null');
            // If you need to ensure that this column references a column in the alumni_profiles table, specify it using `constrained('alumni_profiles')`.
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
            $table->dropForeign(['alumni_profile_id']);
            $table->dropColumn('alumni_profile_id');
        });
    }
}

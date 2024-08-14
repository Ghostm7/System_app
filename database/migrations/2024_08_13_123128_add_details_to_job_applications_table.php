<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToJobApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->string('name')->nullable(); // Add nullable() if you want this field to be optional
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
        });
    }

    public function down()
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn(['name', 'phone_number', 'address']);
        });
    }
}

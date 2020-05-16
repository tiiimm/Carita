<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->after('email')->default('');
            $table->string('role')->after('google_id')->default('none');
            $table->integer('points')->after('role')->default(0);
            $table->string('address')->after('points')->default('');
            $table->string('contact_number')->after('address')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google_id');
            $table->dropColumn('role');
            $table->dropColumn('points');
            $table->dropColumn('address');
            $table->dropColumn('contact_number');
        });
    }
}

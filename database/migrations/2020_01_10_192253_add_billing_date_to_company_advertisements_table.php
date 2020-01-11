<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillingDateToCompanyAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_advertisements', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->date('billing_date')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_advertisements', function (Blueprint $table) {
            $table->dropColumn('billing_date');
            $table->dropColumn('name');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAdvertisementPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_advertisement_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_advertisement_id');
            $table->unsignedBigInteger('company_id');
            $table->date('inclusive_from');
            $table->date('inclusive_to');
            $table->date('date_paid');
            $table->double('amount');
            $table->timestamps();

            $table->foreign('company_advertisement_id')->references('id')->on('company_advertisements')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_advertisement_payments');
    }
}

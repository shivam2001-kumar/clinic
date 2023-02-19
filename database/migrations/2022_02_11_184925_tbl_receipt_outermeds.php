<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblReceiptOutermeds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_receipt_outermeds', function (Blueprint $table) {
            $table->increments('rec_outermed_id');
            $table->BigInteger('patient_id');
            $table->BigInteger('receipt_id');
            $table->text('outer_med_name');
            $table->string('outer_med_dose',500);
            $table->string('outer_med_time',500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

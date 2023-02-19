<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_bills', function (Blueprint $table) {
            $table->bigIncrements('receipt_bill_id');
            $table->bigInteger('receipt_id');
            $table->bigInteger('med_id');
            $table->string('quantity',10);
            $table->decimal('per_qty_amt',12,2);
            $table->decimal('net_amt',12,2);
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
        Schema::dropIfExists('receipt_bills');
    }
}

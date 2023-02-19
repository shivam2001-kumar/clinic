<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulkBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_bills', function (Blueprint $table) {
            $table->id();
            $table->string('billno');
            $table->decimal('billamount',12,2);
            $table->decimal('piadamount',12,2);
            $table->decimal('dueamount',12,2);
            $table->string('billdate');
            $table->string('billpic');
            $table->string('description');
            $table->string('status');
            $table->boolean('is_del')->null(0);
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
        Schema::dropIfExists('bulk_bills');
    }
}

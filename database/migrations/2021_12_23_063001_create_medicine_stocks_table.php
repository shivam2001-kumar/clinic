<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('medcode');
            $table->string('medname');
            $table->string('medtype');
            $table->string('medunit');
            $table->string('price');
            $table->string('medquantity');
            $table->decimal('perqtamount',12,2);
            $table->string('totalquantity');
            $table->decimal('totalprice',12,2);
            $table->boolean('is_del')->default(0);
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
        Schema::dropIfExists('medicine_stocks');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulkDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_datas', function (Blueprint $table) {
            $table->id();
            $table->string('billno');
            $table->string('medcode');
            $table->string('medname');
            $table->string('medtype');
            $table->string('medunit');
            $table->decimal('price',12,2);
            $table->string('medquantity');
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
        Schema::dropIfExists('bulk_datas');
    }
}

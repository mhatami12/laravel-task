<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webservice_id')->nullable();
            $table->foreign('webservice_id')
                ->references('id')
                ->on('web_services')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');;
            $table->integer('amount');
            $table->integer('type');//0:web,1:mobile,2:pos
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

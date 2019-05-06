<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c89504fb01ccRelationshipsToTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function(Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'name_id')) {
                $table->integer('name_id')->unsigned()->nullable();
                $table->foreign('name_id', '277280_5c894eb4879f7')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('transactions', 'id_number_id')) {
                $table->integer('id_number_id')->unsigned()->nullable();
                $table->foreign('id_number_id', '277280_5c894eb4a1b21')->references('id')->on('users')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function(Blueprint $table) {
            
        });
    }
}

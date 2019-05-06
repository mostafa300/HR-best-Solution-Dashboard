<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552502860TransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            if(Schema::hasColumn('transactions', 'location')) {
                $table->dropColumn('location');
            }
            
        });
Schema::table('transactions', function (Blueprint $table) {
            
if (!Schema::hasColumn('transactions', 'location')) {
                $table->string('location')->nullable();
                }
if (!Schema::hasColumn('transactions', 'type')) {
                $table->string('type')->nullable();
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('type');
            
        });
Schema::table('transactions', function (Blueprint $table) {
                        $table->string('location')->nullable();
                
        });

    }
}

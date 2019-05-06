<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1552500157UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
if (!Schema::hasColumn('users', 'position')) {
                $table->string('position')->nullable();
                }
if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
                }
if (!Schema::hasColumn('users', 'id_number')) {
                $table->string('id_number')->nullable();
                }
if (!Schema::hasColumn('users', 'salary')) {
                $table->string('salary')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropColumn('phone');
            $table->dropColumn('id_number');
            $table->dropColumn('salary');
            
        });

    }
}

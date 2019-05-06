<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c89514f9523dTaskUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('task_user')) {
            Schema::create('task_user', function (Blueprint $table) {
                $table->integer('task_id')->unsigned()->nullable();
                $table->foreign('task_id', 'fk_p_277299_277240_user_t_5c89514f95368')->references('id')->on('tasks')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', 'fk_p_277240_277299_task_u_5c89514f953f4')->references('id')->on('users')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_user');
    }
}

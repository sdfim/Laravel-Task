<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('position_id', false, true);
            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->string('phone');
            $table->string('email');
            $table->float('salary', 8, 2);
            $table->string('photo')->nullable();
            $table->dateTime('date_employment', $precision = 0);
            $table->bigInteger('head_id', false, true);
            $table->foreign('head_id')
                ->references('id')
                ->on('employees')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->integer('admin_created_id');
            $table->integer('admin_updated_id');
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
        Schema::dropIfExists('employees');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_expenses', function (Blueprint $table) {
            $table->id();
            $table->string("client");
            $table->text("desc");
            $table->string("status");
            $table->string("Assmanager");
            $table->string("commencement");
            $table->string("completion");
            $table->string("fee");
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
        Schema::dropIfExists('project_expenses');
    }
}

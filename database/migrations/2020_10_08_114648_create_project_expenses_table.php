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
            $table->foreignId("projects_id")->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->index("projects_id");
            $table->foreignId("user_id")->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->index("user_id");
            $table->text("desc");
            $table->string("amount");
            $table->string("status");
            $table->string("viewed");
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

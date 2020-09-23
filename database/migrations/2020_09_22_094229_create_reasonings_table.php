<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReasoningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reasonings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->index("user_id");
            $table->foreignId("project_expenses_id")
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->index("project_expenses_id");
            $table->text("clarification");
            $table->text("reason");
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
        Schema::dropIfExists('reasonings');
    }
}

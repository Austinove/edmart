<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovedExpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approved_exps', function (Blueprint $table) {
            $table->id();
            $table->foreignId("expences_id")
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->index('expences_id');
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
        Schema::dropIfExists('approved_exps');
    }
}

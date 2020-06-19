<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedExpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_exps', function (Blueprint $table) {
            $table->id();
            $table->foreignId("exp_id")->constrained("expences")->index();
            $table->string("viewed");
            $table->string("recommended");
            $table->string("aproved");
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
        Schema::dropIfExists('requested_exps');
    }
}

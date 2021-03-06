<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelledExpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelled_exps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expences_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->index('expences_id');
            $table->string('viewed');
            $table->string('reason');
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
        Schema::dropIfExists('cancelled_exps');
    }
}

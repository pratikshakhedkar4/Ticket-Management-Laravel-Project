<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users','id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('mobile');
            $table->string('assets');
            $table->string('priority');
            $table->string('serial_number');
            $table->string('model_number');
            $table->string('status')->default('Pending');
            $table->foreignId('agent_id')->constrained('users','id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->date('status_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}

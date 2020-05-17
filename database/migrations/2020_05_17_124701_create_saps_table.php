<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saps', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('middleName');
            $table->string('gender');
            $table->string('birthDay');
            $table->string('birthMonth');
            $table->string('birthYear');
            $table->string('received');
            $table->string('receivedWhere');
            $table->string('receviedWhen');
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
        Schema::dropIfExists('saps');
    }
}

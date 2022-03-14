<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('name', 200);
            $table->string('address', 255);
            $table->string('rtrw', 100);
            $table->string('phone', 20);
            $table->date('birth_date');
			$table->enum('gender', ['L', 'P']);
            $table->uuid('village_id');
            $table->timestamps();
			$table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};

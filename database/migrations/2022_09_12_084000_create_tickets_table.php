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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('priority_id')->constrained();
            $table->foreignId('status_id')->references('id')->on('statuses');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('developer_id', "user_id")->reference("id")->on("users")->nullable()->onDelete('cascade');
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
};
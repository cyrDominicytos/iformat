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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id("classrooms_id");
            $table->string('classrooms_name', 255);
            $table->integer('classrooms_countries_id');
            $table->integer('classrooms_status')->default(1);
            $table->text('classrooms_detail')->nullable();

            $table->foreignId("classrooms_user_created_by")->nullable()->constrained("users","id");
            $table->integer("classrooms_user_updated_by")->nullable();
            $table->timestamp('classrooms_created_at');
            $table->timestamp('classrooms_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
};

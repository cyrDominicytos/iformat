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
        Schema::create('plannings', function (Blueprint $table) {
            $table->id("plannings_id");
            $table->string('plannings_code', 255)->unique();
            $table->text('plannings_infos')->nullable();
            $table->json("plannings_teachers")->nullable();
            $table->json("plannings_teachers_roles")->nullable();
            $table->json("plannings_user_groups")->nullable();
            $table->integer('plannings_status')->default(1);
            $table->date('plannings_date');
            $table->string('plannings_time_slot', 10);
            
            $table->foreignId("plannings_user_created_by")->nullable()->constrained("users","id");
            $table->foreignId("plannings_learning_id")->nullable()->constrained("learnings","learnings_id")->onDelete("CASCADE");
            $table->foreignId("plannings_classroom_id")->nullable()->constrained("classrooms","classrooms_id");
            $table->integer("plannings_user_updated_by")->nullable();
            $table->timestamp('plannings_created_at');
            $table->timestamp('plannings_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plannings');
    }
};

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
        Schema::create('learnings', function (Blueprint $table) {
            $table->id("learnings_id");
            $table->string('learnings_title', 255);
            $table->string('learnings_title2', 255)->nullable();
            $table->text('learnings_goal')->nullable();
            $table->text('learnings_target')->nullable();
            $table->text('learnings_duration')->nullable();
            $table->text('learnings_infos')->nullable();
            $table->integer("learnings_author_id")->nullable();
            $table->json("learnings_days")->nullable();
            $table->json("learnings_time_slot")->nullable();
            $table->integer('learnings_status')->default(1);

            $table->foreignId("learnings_user_created_by")->nullable()->constrained("users","id");
            $table->integer("learnings_user_updated_by")->nullable();
            $table->timestamp('learnings_created_at');
            $table->timestamp('learnings_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learnings');
    }
};

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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id("certifications_id");
            $table->string('certifications_code', 255)->unique();
            $table->json("certifications_participant")->nullable();
            $table->foreignId("certifications_learnings_id")->nullable()->constrained("learnings","learnings_id")->onDelete("CASCADE");
            $table->integer('certifications_status')->default(1);
           
            $table->foreignId("certifications_user_created_by")->nullable()->constrained("users","id");
            $table->integer("certifications_user_updated_by")->nullable();
            $table->timestamp('certifications_created_at');
            $table->timestamp('certifications_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certifications');
    }
};

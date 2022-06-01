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
        Schema::create('presences', function (Blueprint $table) {
            $table->id("presences_id");
            $table->string('presences_code', 255)->unique();
            $table->json("presences_participant")->nullable();
            $table->date('presences_date');
            $table->foreignId("presences_planning_id")->nullable()->constrained("plannings","plannings_id")->onDelete("CASCADE");
            $table->integer('presences_status')->default(1);
           
            $table->foreignId("presences_user_created_by")->nullable()->constrained("users","id");
            $table->integer("presences_user_updated_by")->nullable();
            $table->timestamp('presences_created_at');
            $table->timestamp('presences_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presences');
    }
};

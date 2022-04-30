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
        Schema::create('groups', function (Blueprint $table) {
            $table->id("groups_id");
            $table->string('groups_name', 255);
            $table->json('groups_participant')->nullable();
            $table->integer('groups_status')->default(1);
            $table->text('groups_detail')->nullable();

            $table->foreignId("groups_user_created_by")->nullable()->constrained("users","id");
            $table->integer("groups_user_updated_by")->nullable();
            $table->timestamp('groups_created_at');
            $table->timestamp('groups_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
};

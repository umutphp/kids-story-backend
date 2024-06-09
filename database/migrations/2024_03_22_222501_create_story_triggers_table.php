<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('story_triggers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->nullable()->default(null);
            $table->enum("status", ["new", "pending", "generated"]);
            $table->json("characters")->nullable();
            $table->json("parameters")->nullable();
            $table->timestamp('generation_started_at')->nullable();
            $table->timestamp('generation_finished_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_triggers');
    }
};

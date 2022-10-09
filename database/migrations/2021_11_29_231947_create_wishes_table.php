<?php

use App\Models\User;
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
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('title', 100);
            $table->string('type');
            $table->string('price')->nullable();
            $table->string('link', 100)->nullable();
            $table->timestamp('date')->nullable();
            $table->enum('status', ['in_progress', 'completed'])->default('in_progress');
            $table->string('comment', 140)->nullable();
            $table->timestamp('completed_date')->nullable();
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
        Schema::dropIfExists('wishes');
    }
};

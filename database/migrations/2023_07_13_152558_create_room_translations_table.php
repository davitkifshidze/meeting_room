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
        Schema::create('room_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('room_id')->unsigned();
            $table->string('locale',254)->index()->nullable();

            $table->string('name')->nullable()->default(NULL);

            $table->unique(['room_id','locale']);
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_translations');
    }
};

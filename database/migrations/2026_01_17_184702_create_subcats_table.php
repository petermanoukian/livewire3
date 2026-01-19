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
        Schema::create('subcats', function (Blueprint $table) {
            $table->id();

            // Foreign key to cats
            $table->unsignedBigInteger('catid');
            $table->string('name', 255);
            $table->text('des')->nullable();
            $table->longText('dess')->nullable();
            $table->string('img')->nullable();
            $table->string('img2')->nullable();
            $table->string('filer')->nullable();
            $table->timestamps();
            $table->unique(['catid', 'name']);
            $table->foreign('catid')
                  ->references('id')
                  ->on('cats')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcats');
    }
};


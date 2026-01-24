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

            // Subcategory name
            $table->string('name', 255);

            // Optional description fields
            $table->text('des')->nullable();
            $table->longText('dess')->nullable();
            $table->string('img')->nullable();
            $table->string('img2')->nullable();
            $table->string('filer')->nullable();

            $table->timestamps();

            // Unique constraint across catid + name
            $table->unique(['catid', 'name'], 'unique_subcat_cat_name');

            // Foreign key constraint
            $table->foreign('catid')
                ->references('id')
                ->on('cats')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subcats');
    }
};

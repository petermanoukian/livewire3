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
        Schema::create('prods', function (Blueprint $table) {
            $table->id();

            // Foreign keys to cats and subcats
            $table->unsignedBigInteger('catid');
            $table->unsignedBigInteger('subcatid');

            // Product name
            $table->string('name', 190);

            // Optional description fields if needed
            $table->text('des')->nullable();
            $table->longText('dess')->nullable();
            $table->string('img')->nullable();
            $table->string('img2')->nullable();
            $table->string('filer')->nullable();

            $table->timestamps();

            // Unique constraint across catid, subcatid, name
            $table->unique(['catid', 'subcatid', 'name'], 'unique_prod_cat_subcat_name');

            // Foreign key constraints
            $table->foreign('catid')
                ->references('id')
                ->on('cats')
                ->onDelete('cascade');

            $table->foreign('subcatid')
                ->references('id')
                ->on('subcats')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prods');
    }

};



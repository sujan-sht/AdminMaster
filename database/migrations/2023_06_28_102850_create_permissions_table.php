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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->boolean('browse')->default(1);
            $table->boolean('read')->default(1);
            $table->boolean('edit')->default(1);
            $table->boolean('add')->default(1);
            $table->boolean('delete')->default(1);
            $table->string('name')->nullable();
            $table->boolean('can')->nullable();
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->string('model')->default('all');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};

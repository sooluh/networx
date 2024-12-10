<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assesments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternative_id')->constrained()->cascadeOnDelete();
            $table->foreignId('criteria_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subcriteria_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assesments');
    }
};

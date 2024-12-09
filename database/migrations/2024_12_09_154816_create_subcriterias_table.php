<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subcriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('criteria_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subcriterias');
    }
};

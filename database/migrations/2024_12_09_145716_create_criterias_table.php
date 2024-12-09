<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('code');
            $table->string('name');
            $table->decimal('weight', 4, 2)->default('0.00');
            $table->integer('type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};

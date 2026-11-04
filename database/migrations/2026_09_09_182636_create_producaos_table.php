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
        Schema::create('producaos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('material_id')
                ->constrained('materials')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('origem_id')
                ->constrained('origens')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date('data_producao');
            $table->decimal('quantidade', 12, 2);
            $table->string('unidade', 10)->default('t');
            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producaos');
    }
};

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
    Schema::create('movimentacaos', function (Blueprint $table) {
        $table->id();

        $table->foreignId('material_id')
            ->constrained('materials')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

        $table->foreignId('patio_origem_id')
            ->constrained('patios')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

        $table->foreignId('patio_destino_id')
            ->constrained('patios')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

        $table->decimal('quantidade', 12, 2);
        $table->date('data_movimentacao');
        $table->time('hora_movimentacao')->nullable();
        $table->text('observacao')->nullable();

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('movimentacaos');
    }
};

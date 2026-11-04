<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('producaos', function (Blueprint $table) {
            $table->foreignId('destino_id')
                ->nullable()
                ->constrained('destinos')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('producaos', function (Blueprint $table) {
            $table->dropForeign(['destino_id']);
            $table->dropColumn('destino_id');
        });
    }
};

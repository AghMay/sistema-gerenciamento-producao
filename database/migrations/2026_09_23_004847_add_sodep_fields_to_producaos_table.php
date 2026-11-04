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
        Schema::table('producaos', function (Blueprint $table) {

            // ID original do registro no SODEP
            $table->unsignedBigInteger('sodep_id')
                ->nullable()
                ->unique()
                ->after('id');

            // Código da viagem informado pelo SODEP
            $table->string('cod_viagem', 50)
                ->nullable()
                ->after('sodep_id');

            // Equipamento utilizado na produção
            $table->string('equipamento', 100)
                ->nullable();

            // Operador responsável
            $table->string('operador', 150)
                ->nullable();

            // Turno
            $table->string('turno', 100)
                ->nullable();

            // Litologia
            $table->string('litologia', 100)
                ->nullable();

            // Mina
            $table->string('mina', 150)
                ->nullable();

            // Tipo do material informado pelo SODEP
            $table->string('tipo_material', 100)
                ->nullable();

            // Data/hora original do registro no SODEP
            $table->dateTime('sodep_data_registro')
                ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('producaos', function (Blueprint $table) {

            $table->dropUnique([
                'producaos_sodep_id_unique'
            ]);

            $table->dropColumn([
                'sodep_id',
                'cod_viagem',
                'equipamento',
                'operador',
                'turno',
                'litologia',
                'mina',
                'tipo_material',
                'sodep_data_registro',
            ]);
        });
    }
};

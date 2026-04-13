<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 1. Expandir ENUM (permitir valores nuevos y antiguos)
        DB::statement("ALTER TABLE pedidos MODIFY estado ENUM(
            'Pendiente',
            'Pendiente_pago',
            'Pagado',
            'Fallido',
            'Enviado',
            'Entregado'
        ) DEFAULT 'Pendiente'");

        // 2. Convertir datos antiguos
        DB::statement("UPDATE pedidos SET estado = 'Pendiente_pago' WHERE estado = 'Pendiente'");

        // 3. Limpiar ENUM (quitar valor viejo)
        DB::statement("ALTER TABLE pedidos MODIFY estado ENUM(
            'Pendiente_pago',
            'Pagado',
            'Fallido',
            'Enviado',
            'Entregado'
        ) DEFAULT 'Pendiente_pago'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE pedidos MODIFY estado ENUM(
            'Pendiente',
            'Enviado',
            'Entregado'
        ) DEFAULT 'Pendiente'");
    }
};

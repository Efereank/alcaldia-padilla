<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Eliminar la clave foránea existente
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        // Modificar la columna para permitir NULL
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->change();
        });

        // Volver a crear la clave foránea con ON DELETE SET NULL
        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null'); // ← ESTO PONE NULL AL ELIMINAR LA CATEGORÍA
        });
    }

    public function down(): void
    {
        // Revertir los cambios (por si necesitas deshacer)
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable(false)->change();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories');
        });
    }
};
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
        Schema::table('frutas', function (Blueprint $table) {
            $table->renameColumn('nombre_fruta', 'nombre');
            $table->renameColumn('color_fruta', 'color');
            $table->renameColumn('precio_fruta', 'precio');
            $table->string('pais_origen')->after('nombre')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('frutas', function (Blueprint $table) {
            $table->renameColumn('nombre', 'nombre_fruta');
            $table->renameColumn('color', 'color_fruta');
            $table->renameColumn('precio', 'precio_fruta');
            $table->dropColumn('pais_origen');
        });
    }
};

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
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('fk_venue_event')->nullable()->constrained('venues', 'id');
        });//se pone nullable porque tenemos ya datos en la tabla y no podemos poner un campo obligatorio sin valor por defecto
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //para las llaves foraneas eliminar primero constraint y luego la columna
            $table->dropForeign(['fk_venue_event']);
            $table->dropColumn('fk_venue_event');
        });
    }
};

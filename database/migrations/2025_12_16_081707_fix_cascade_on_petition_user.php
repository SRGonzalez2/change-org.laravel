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
        Schema::table('petition_user', function (Blueprint $table) {

            // eliminar FKs actuales
            $table->dropForeign(['petition_id']);
            $table->dropForeign(['user_id']);

            // recrear con cascade
            $table->foreign('petition_id')
                ->references('id')
                ->on('petitions')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

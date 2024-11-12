<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Verifica si la columna 'username' ya existe antes de agregarla
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->after('email'); // Añade el campo 'username'
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimina la columna 'username'
            $table->dropColumn('username');
        });
    }
}

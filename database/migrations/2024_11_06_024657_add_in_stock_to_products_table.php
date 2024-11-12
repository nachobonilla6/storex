<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInStockToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Añadir columna in_stock con un valor máximo de 1000
            $table->unsignedInteger('in_stock')->default(0)->check('in_stock <= 1000');  // Limitar a 1000
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('in_stock');  // Eliminar el campo in_stock en caso de revertir la migración
        });
    }
}

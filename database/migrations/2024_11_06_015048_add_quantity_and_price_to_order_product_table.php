<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityAndPriceToOrderProductTable extends Migration
{
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->change();
            $table->decimal('price', 8, 2)->default(1)->change();
        });
    }

    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->integer('quantity')->default(0)->change(); // Puedes establecer el valor predeterminado a 0 si deseas revertir
            $table->decimal('price', 8, 2)->default(0)->change(); // Establecer a 0 si lo deseas revertir
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2); // Puedes ajustar el tamaño según sea necesario
            $table->string('size');
            $table->string('image_url')->nullable(); // Si la imagen no es obligatoria
            $table->integer('in_stock')->nullable()->default(0)->unsigned()->comment('Stock quantity, maximum 1000')->check('in_stock <= 1000');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

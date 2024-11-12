<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePriceDefaultOnOrderProduct extends Migration
{
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->default(0.00)->change();
        });
    }

    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->default(null)->change();
        });
    }
}

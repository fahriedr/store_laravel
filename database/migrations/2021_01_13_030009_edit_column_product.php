<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumnProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table){
            $table->renameColumn('product_id', 'id');
            $table->renameColumn('product_name', 'name');
            $table->renameColumn('product_price', 'price');
            $table->renameColumn('product_stock', 'stock');
            $table->renameColumn('product_weight', 'weight');
            $table->renameColumn('product_desc', 'description');
            $table->dropColumn('product_pict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table){
            $table->renameColumn('id', 'product_id');
            $table->renameColumn('name', 'product_name');
            $table->renameColumn('price', 'product_price');
            $table->renameColumn('stock', 'product_stock');
            $table->renameColumn('weight', 'product_weight');
            $table->renameColumn('description', 'product_desc');
            $table->string('product_pict');
        });
    }
}

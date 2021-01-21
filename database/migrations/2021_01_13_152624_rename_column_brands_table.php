<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function(Blueprint $table) {
            $table->renameColumn('brand_id', 'id');
            $table->renameColumn('brand_code', 'code');
            $table->renameColumn('brand_logo', 'logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function(Blueprint $table) {
            $table->renameColumn('id', 'brand_id');
            $table->renameColumn('code', 'brand_code');
            $table->renameColumn('logo', 'brand_logo');
        });
    }
}

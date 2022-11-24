<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWoUploadToProducttCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productt_categories', function (Blueprint $table) {
            //
            $table->text('wo_upload')->default('no');
            $table->text('shopify_upload')->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productt_categories', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToAddonCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addon_cart_details', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('cart_id');
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addon_cart_details', function (Blueprint $table) {
            $table->dropForeign('addon_cart_details_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
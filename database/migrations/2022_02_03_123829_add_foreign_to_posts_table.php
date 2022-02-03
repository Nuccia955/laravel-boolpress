<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // add col for FK
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            // connect to table 'categories'
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // stop relation with table 'categories'
            $table->dropForeign('posts_category_id_foreign');

            //drop FK
            $table->dropColumn('category_id');
        });
    }
}

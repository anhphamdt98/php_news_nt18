<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->string('type')->default('image')->change();
            $table->unsignedBigInteger('post_id')->change();

            if (Schema::hasColumn('medias', 'post_id')) {
                $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');
            } 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('medias')) 
        {
            Schema::table('medias', function (Blueprint $table) {
                if (Schema::hasColumn('medias', 'post_id')) {
                    $table->dropForeign(['post_id']);
                } 
                if (Schema::hasColumn('medias', 'type')) {
                    $table->dropColumn('type');
                }  
            });
        }
        
    }
}

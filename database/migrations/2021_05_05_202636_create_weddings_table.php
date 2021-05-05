<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weddings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('first_npc_id');
            $table->unsignedBigInteger('second_npc_id')->nullable();
            $table->timestamps();

            $table->foreign('first_npc_id')
                  ->references('id')
                  ->on('npcs')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->foreign('second_npc_id')
                  ->references('id')
                  ->on('npcs')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });

        Schema::table('npcs', function (Blueprint $table) {
            $table->unsignedBigInteger('wedding_id')->nullable();
            $table->foreign('wedding_id')
                  ->references('id')
                  ->on('weddings')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('npcs', function (Blueprint $table) {
            $table->dropForeign(['wedding_id']);
            $table->dropColumn('wedding_id');
        });
        Schema::dropIfExists('weddings');
    }
}

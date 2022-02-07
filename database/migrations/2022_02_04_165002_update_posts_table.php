<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //creo la colonna fk: le assegno il nome category_id, che sarà nullable e la posizione dopo la colonna id
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            //assegno le fk alla colonna appena creata che si riferisce all'id della tabella categories; se non c'è categoria, assegno null
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
        //mi serve in caso di rollback: dico di eliminare la fk e la colonna
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}

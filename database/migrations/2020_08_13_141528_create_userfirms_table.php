<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userfirms', function (Blueprint $table) {
            $table->bigInteger('firms_id');
            $table->foreign('firms_id')->references('id')->on('firms')->onDelete('cascade');
            $table->bigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['firms_id', 'users_id']);
        });
    }
    /*
    INSERT INTO userfirms (firms_id, users_id) VALUES (1, 2);
    INSERT INTO userfirms (firms_id, users_id) VALUES (1, 3);
    INSERT INTO userfirms (firms_id, users_id) VALUES (2, 4);
    INSERT INTO userfirms (firms_id, users_id) VALUES (2, 5);
    INSERT INTO userfirms (firms_id, users_id) VALUES (2, 6);
    INSERT INTO userfirms (firms_id, users_id) VALUES (3, 7);
    INSERT INTO userfirms (firms_id, users_id) VALUES (3, 8);
    INSERT INTO userfirms (firms_id, users_id) VALUES (3, 9);
    INSERT INTO userfirms (firms_id, users_id) VALUES (4, 10);
    INSERT INTO userfirms (firms_id, users_id) VALUES (4, 11);
    INSERT INTO userfirms (firms_id, users_id) VALUES (5, 12);
    INSERT INTO userfirms (firms_id, users_id) VALUES (5, 13);
    INSERT INTO userfirms (firms_id, users_id) VALUES (5, 14);
    INSERT INTO userfirms (firms_id, users_id) VALUES (5, 15);
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userfirms');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmdepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firmdeps', function (Blueprint $table) {
            $table->bigInteger('firms_id');
            $table->foreign('firms_id')->references('id')->on('firms')->onDelete('cascade');
            $table->bigInteger('deps_id');
            $table->foreign('deps_id')->references('id')->on('deps')->onDelete('cascade');
            $table->unique(['firms_id', 'deps_id']);
        });
    }
    /*
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (1, 1);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (2, 2);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (3, 3);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (4, 4);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (5, 5);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (1, 6);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (1, 7);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (1, 8);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (2, 9);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (2, 10);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (3, 11);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (3, 12);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (3, 13);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (3, 20);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (4, 15);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (5, 16);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (5, 17);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (5, 18);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (5, 19);
    INSERT INTO firmdeps (firms_id, deps_id) VALUES (5, 21);
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firmdeps');
    }
}

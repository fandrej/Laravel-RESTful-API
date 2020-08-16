<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('towns', function (Blueprint $table) {
            $table->id();   // PRIMARY_KEY BIGINT autoincrement (+sequence if needded)
            $table->string('name', 100); 	// Эквивалент VARCHAR с длиной.
            $table->string('tz', 7)->comment('Часовой пояс: UTC+X');
        });
    }
    /*
    INSERT INTO towns (NAME, tz) VALUES ('Москва', 'UTC+3');
    INSERT INTO towns (NAME, tz) VALUES ('Калининград', 'UTC+2');
    INSERT INTO towns (NAME, tz) VALUES ('Ростов', 'UTC+3');
    INSERT INTO towns (NAME, tz) VALUES ('Екатеринбург', 'UTC+5');
    INSERT INTO towns (NAME, tz) VALUES ('Владивосток', 'UTC+10');
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('towns');
    }
}

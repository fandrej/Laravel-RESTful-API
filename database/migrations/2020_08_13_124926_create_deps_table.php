<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deps', function (Blueprint $table) {
            $table->id();
            $table->string('name', 300);
            $table->string('address', 100)->nullable()->comment('Адрес');
            $table->string('point', 50)->nullable()->comment('Географические координаты в формате lon;lat');
            $table->enum('type', ['Кафе', 'Офис'])->nullable()->comment('Тип'); // https://metanit.com/sql/postgresql/5.2.php
        });
    }
    /*
    INSERT INTO deps (NAME, address, "type") VALUES ('Офис', 'ул. Ленина, д. 1', 'Офис');
    INSERT INTO deps (NAME, address, "type") VALUES ('Офис', 'ул. Ленина, д. 2', 'Офис');
    INSERT INTO deps (NAME, address, "type") VALUES ('Офис', 'ул. Ленина, д. 3', 'Офис');
    INSERT INTO deps (NAME, address, "type") VALUES ('Офис', 'ул. Ленина, д. 4', 'Офис');
    INSERT INTO deps (NAME, address, "type") VALUES ('Офис', 'ул. Ленина, д. 5', 'Офис');
    INSERT INTO deps (NAME, address, "type") VALUES ('ВСЕ БУДЕТ ХОРОШО', 'ул. Цветочная, д. 12', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('КАКИЕ ЛЮДИ', 'ул. Ломаная, д. 17', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ХОМЯЧКИ', 'ул. Старообрядческая, д. 22', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ЗЕЛЕНОГЛАЗОЕ ТАКСИ', 'ул. Счастливая, д. 54', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('МАКАРЕНА', 'Химический переулок, д. 68', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ЖИТЬ ХОРОШО', 'ул. Шотландская, д. 1', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('БРАТИШКА', 'Сиреневый бульвар, д. 14', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ОТЖИГАЙ И ЖГИ', 'Банковский переулок, д. 32', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ЧИХ-ПЫХ', 'ул. Мебельная, д. 21', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ВИННИ ПЫХ', 'ул. Центральная, д. 11', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ВОДКА БЕЗ ПИВА, ДЕНЬГИ НА ВЕТЕР', 'ул. Молодежная, д. 15', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ВОДКА ДЛЯ ОСОБО ВАЖНЫХ ПЕРСОН', 'ул. Школьная, д. 9', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ПИВАСИК И КАРАСИК', 'ул. Лесная, д. 7', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('ПИТЬ ХОЧУ', 'ул. Советская, д. 55', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('БЕШЕНАЯ ТАБУРЕТКА', 'ул. Новая, д. 68А', 'Кафе');
    INSERT INTO deps (NAME, address, "type") VALUES ('МАМА ПРИГОТОВИЛА', 'ул. Садовая, д. 3, к.1', 'Кафе');
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deps');
    }
}

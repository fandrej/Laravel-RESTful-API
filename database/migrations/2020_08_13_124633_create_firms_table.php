<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 300);
            $table->string('ownership', 10)->comment('Форма собственности (ИП, ООО и т.п.)');
            $table->string('boss', 100)->comment('ФИО директора');
        });
    }
    /*
    INSERT INTO firms (NAME, ownership, boss) VALUES ('Рога и копыта', 'OOO', 'Самойлова Светлана Григорьевна');
    INSERT INTO firms (NAME, ownership, boss) VALUES ('40 лет без урожая', 'OАO', 'Коновалова Ева Ивановна');
    INSERT INTO firms (NAME, ownership, boss) VALUES ('Красный лапоть', 'ЗАO', 'Данилов Егор Артёмович');
    INSERT INTO firms (NAME, ownership, boss) VALUES ('ПАНЬКИ', 'OOO', 'Климов Пётр Иванович');
    INSERT INTO firms (NAME, ownership, boss) VALUES ('Никифоров В. А.', 'ИП', 'Никифоров Виктор Антонович');
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firms');
    }
}

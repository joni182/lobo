<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('subtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id');
            $table->string('name');

            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('cascade');
        });

        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('subtype_id');
            $table->string('name');
            $table->string('avatar');
            $table->date('birth_date');
            $table->date('death_date');
            $table->string('chip')->unique();
            $table->decimal('weight',6,2);
            $table->boolean('ppp');
            $table->boolean('sterilized');
            $table->boolean('sex'); //1 for males 0 for females
            $table->text('observations')->nullable();

            $table->timestamps();

            $table->foreign('subtype_id')
                ->references('id')
                ->on('subtypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_types');
        Schema::dropIfExists('types');
        Schema::dropIfExists('animals');
    }
}

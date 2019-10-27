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
            $table->string('avatar')->nullable();
            $table->date('birth_date');
            $table->date('death_date')->nullable();
            $table->string('chip')->unique()->nullable();
            $table->decimal('weight', 6, 2);
            $table->boolean('dangerous')->default(false); // PPP Perros Potencialmente Peligrosos
            $table->boolean('sterilized')->default(false);
            $table->boolean('sex'); //1 for males 0 for females
            $table->text('observations')->nullable();

            $table->timestamps();

            $table->foreign('subtype_id')
                ->references('id')
                ->on('subtypes');
        });

        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('observations')->nullable();

            $table->timestamps();
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
        Schema::dropIfExists('persons');
    }
}

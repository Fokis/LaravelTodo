<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'categories',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            }
        );

        DB::table('categories')->insert(
            [
                ['name' => 'Home'],
                ['name' => 'Work'],
                ['name' => 'General'],
                ['name' => 'Long term'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

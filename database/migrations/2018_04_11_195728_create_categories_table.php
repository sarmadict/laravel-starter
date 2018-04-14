<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = config('tables.categories');

        $categorizables = config('tables.categorizables');

        $users = config('tables.users');

        Schema::create($categories, function (Blueprint $table) use($users){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->smallInteger('type');

            // Nested set properties
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('lft')->nullable();
            $table->unsignedInteger('rgt')->nullable();
            $table->integer('depth')->nullable();

            $table->unsignedInteger('hits')->default(0);
            $table->text('keywords')->nullable();
            $table->smallInteger('state');

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on($users)->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on($users)->onDelete('SET NULL');
        });

        Schema::create($categorizables, function (Blueprint $table) use($categories){
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->morphs('categorizable');

            $table->foreign('category_id')->references('id')->on($categories)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $categories = config('tables.categories');
        $categorizables = config('tables.categorizables');

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists($categories);
        Schema::dropIfExists($categorizables);
        Schema::enableForeignKeyConstraints();
    }
}

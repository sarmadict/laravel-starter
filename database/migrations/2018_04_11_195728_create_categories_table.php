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
        $tables = config('tables');

        $categorizables = config('tables.categorizables');

        $users = config('tables.users');

        Schema::create($tables['categories'], function (Blueprint $table) use ($tables) {
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

            $table->foreign('created_by')->references('id')->on($tables['users'])->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on($tables['users'])->onDelete('SET NULL');
        });

        Schema::create($tables['categorizables'], function (Blueprint $table) use ($tables) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->morphs('categorizable');

            $table->foreign('category_id')->references('id')->on($tables['categories'])->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = config('tables');

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists($tables['categories']);
        Schema::dropIfExists($tables['categorizables']);
        Schema::enableForeignKeyConstraints();
    }
}

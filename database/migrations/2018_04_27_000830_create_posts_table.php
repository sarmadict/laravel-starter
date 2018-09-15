<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = config('tables');

        Schema::create($tables['posts'], function (Blueprint $table) use ($tables) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('excerpt', 8190)->nullable();
            $table->longText('content');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->smallInteger('status');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('image_path', 2046)->nullable();
            $table->unsignedInteger('likes_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expired_at')->nullable();

            $table->unsignedInteger('hits')->default(0);
            $table->text('meta_keywords')->nullable();
            $table->string('meta_description', 8190)->nullable();
            $table->smallInteger('state');

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on($tables['categories'])->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on($tables['users'])->onDelete('SET NULL');
            $table->foreign('created_by')->references('id')->on($tables['users'])->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on($tables['users'])->onDelete('SET NULL');
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
        Schema::dropIfExists($tables['posts']);
        Schema::enableForeignKeyConstraints();
    }
}

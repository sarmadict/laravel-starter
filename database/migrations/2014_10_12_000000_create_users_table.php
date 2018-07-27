<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = config('tables');

        Schema::create($tables['users'], function (Blueprint $table) use ($tables) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('display_name')->nullable();
            $table->string('username', 31)->unique();
            $table->string('email')->unique();
            $table->string('mobile_number', 15)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('position', 255)->nullable();
            $table->smallInteger('gender')->nullable();
            $table->string('image_path', 8190)->nullable();
            $table->date('birthday')->nullable();
            $table->smallInteger('state');
            $table->integer('approved_by')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('approved_by')
                ->references('id')
                ->on($tables['users'])
                ->onDelete('SET NULL');

            $table->foreign('created_by')
                ->references('id')
                ->on($tables['users'])
                ->onDelete('SET NULL');

            $table->foreign('updated_by')
                ->references('id')
                ->on($tables['users'])
                ->onDelete('SET NULL');

            $table->foreign('deleted_by')
                ->references('id')
                ->on($tables['users'])
                ->onDelete('SET NULL');
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
        Schema::dropIfExists($tables['users']);
        Schema::enableForeignKeyConstraints();
    }
}

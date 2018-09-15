<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = config('tables');

        Schema::create($tables['roles'], function (Blueprint $table) use ($tables) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->text('description')->nullable();

            $table->smallInteger('state');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')
                ->references('id')
                ->on($tables['users'])
                ->onDelete('SET NULL');

            $table->foreign('updated_by')
                ->references('id')
                ->on($tables['users'])
                ->onDelete('SET NULL');
        });

        Schema::create($tables['role_user'], function (Blueprint $table) use ($tables) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('user_id');

            $table->foreign('role_id')
                ->references('id')
                ->on($tables['roles'])
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on($tables['users'])
                ->onDelete('cascade');
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

        Schema::dropIfExists($tables['roles']);

        Schema::dropIfExists($tables['role_user']);

        Schema::enableForeignKeyConstraints();
    }
}

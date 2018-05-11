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
        $tables = config('acl.tables');

        Schema::create(array_get($tables, 'roles', 'roles'), function (Blueprint $table) {
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
                ->on('users');

            $table->foreign('updated_by')
                ->references('id')
                ->on('users');
        });

        Schema::create(array_get($tables, 'role_user', 'role_user'), function (Blueprint $table) use ($tables) {
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('user_id');

            $table->foreign('role_id')
                ->references('id')
                ->on(array_get($tables, 'roles', 'roles'))
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        $tables = config('acl.tables');

        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists(array_get($tables, 'roles', 'roles'));

        Schema::dropIfExists(array_get($tables, 'role_user', 'role_user'));

        Schema::enableForeignKeyConstraints();
    }
}

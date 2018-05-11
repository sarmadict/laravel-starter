<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = config('acl.tables');

        Schema::create(array_get($tables, 'permissions', 'permissions'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('group')->nullable();
            $table->smallInteger('type');

            $table->smallInteger('state');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');

            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');
        });

        Schema::create(array_get($tables, 'permissible', 'permissible'), function (Blueprint $table) use ($tables) {
            $table->unsignedInteger('permission_id');
            $table->morphs('permissible');
            $table->unsignedInteger('assigned_by')->nullable();
            $table->timestamp('assigned_at')->nullable();

            $table->foreign('permission_id')
                ->references('id')
                ->on(array_get($tables, 'permissions', 'permissions'))
                ->onDelete('cascade');

            $table->foreign('assigned_by')
                ->references('id')
                ->on('users')
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
        $tables = config('acl.tables');

        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists(array_get($tables, 'permissions', 'permissions'));

        Schema::dropIfExists(array_get($tables, 'permissible', 'permissible'));

        Schema::enableForeignKeyConstraints();
    }
}

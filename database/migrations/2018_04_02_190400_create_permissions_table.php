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
        $tables = config('tables');

        Schema::create($tables['permissions'], function (Blueprint $table) use ($tables) {
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
                ->on($tables['users'])
                ->onDelete('SET NULL');

            $table->foreign('updated_by')
                ->references('id')
                ->on($tables['users'])
                ->onDelete('SET NULL');
        });

        Schema::create($tables['permissible'], function (Blueprint $table) use ($tables) {
            $table->unsignedInteger('permission_id');
            $table->morphs('permissible');
            $table->unsignedInteger('assigned_by')->nullable();
            $table->timestamp('assigned_at')->nullable();

            $table->foreign('permission_id')
                ->references('id')
                ->on($tables['permissions'])
                ->onDelete('cascade');

            $table->foreign('assigned_by')
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

        Schema::dropIfExists($tables['permissions']);

        Schema::dropIfExists($tables['permissible']);

        Schema::enableForeignKeyConstraints();
    }
}

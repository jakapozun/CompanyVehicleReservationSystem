<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
        });

//         Permissions
        Permission::create(['name'=>'view-vehicles','guard_name'=>'web']);
        Permission::create(['name'=>'view-users','guard_name'=>'web']);
        Permission::create(['name'=>'view-roles','guard_name'=>'web']);
        Permission::create(['name'=>'view-reservations','guard_name'=>'web']);

        Permission::create(['name'=>'edit-vehicles','guard_name'=>'web']);
        Permission::create(['name'=>'edit-users','guard_name'=>'web']);
        Permission::create(['name'=>'edit-roles','guard_name'=>'web']);
        Permission::create(['name'=>'edit-reservations','guard_name'=>'web']);

        Permission::create(['name'=>'create-vehicles','guard_name'=>'web']);
        Permission::create(['name'=>'create-users','guard_name'=>'web']);
        Permission::create(['name'=>'create-roles','guard_name'=>'web']);
        Permission::create(['name'=>'create-reservations','guard_name'=>'web']);

        Permission::create(['name'=>'delete-vehicles','guard_name'=>'web']);
        Permission::create(['name'=>'delete-users','guard_name'=>'web']);
        Permission::create(['name'=>'delete-roles','guard_name'=>'web']);
        Permission::create(['name'=>'delete-reservations','guard_name'=>'web']);

        // Roles
        Role::create(['name'=>'super-admin','guard_name'=>'web']);
        Role::create(['name'=>'admin','guard_name'=>'web']);
        Role::create(['name'=>'user','guard_name'=>'web']);
        Role::create(['name'=>'editor','guard_name'=>'web']);
        Role::create(['name'=>'viewer','guard_name'=>'web']);
        Role::create(['name'=>'moderator','guard_name'=>'web']);

        $s_admin = Role::findByName('super-admin');
        $s_admin->givePermissionTo(Permission::all());

        $role_user = Role::findByName('user');
        $role_user->givePermissionTo(['view-vehicles','create-reservations','view-reservations', 'delete-reservations']);


        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}

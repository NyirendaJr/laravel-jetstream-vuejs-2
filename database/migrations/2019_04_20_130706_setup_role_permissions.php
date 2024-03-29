<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Laravue\Models\Role;
use App\Laravue\Models\Permission;
use App\Laravue\Acl;

class SetupRolePermissions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    foreach (Acl::roles() as $role) {
      Role::findOrCreate($role);
    }

    $adminRole = Role::findByName(Acl::ROLE_ADMIN);
    $managerRole = Role::findByName(Acl::ROLE_MANAGER);
    $salesRole = Role::findByName(Acl::ROLE_SALES);


    foreach (Acl::permissions() as $permission) {
      Permission::findOrCreate($permission, 'sanctum');
    }

    // Setup basic permission
    $adminRole->givePermissionTo(Acl::permissions());
    $managerRole->givePermissionTo(Acl::permissions([Acl::PERMISSION_PERMISSION_MANAGE]));

    foreach (Acl::roles() as $role) {
      /** @var \App\User[] $users */
      $users = \App\Laravue\Models\User::where('role', $role)->get();
      $role = Role::findByName($role);
      foreach ($users as $user) {
        $user->syncRoles($role);
      }
    }

    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('role');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    if (!Schema::hasColumn('users', 'role')) {
      Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('editor');
      });
    }

    /** @var \App\User[] $users */
    $users = \App\Laravue\Models\User::all();
    foreach ($users as $user) {
      $roles = array_reverse(Acl::roles());
      foreach ($roles as $role) {
        if ($user->hasRole($role)) {
          $user->role = $role;
          $user->save();
        }
      }
    }
  }
}

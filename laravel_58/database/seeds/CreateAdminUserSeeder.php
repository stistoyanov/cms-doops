<?php

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        $password = bcrypt(env('SEED_USER_PASSWORD'));

        $users = [
            [
                'name' => 'SYSTEM',
                'email' => 'info@beluga.software',
                'password' => $password,
            ],
            [
                'name' => 'Stan Todorov',
                'email' => 's.todorov@beluga.software',
                'password' => $password,
            ],
            [
                'name' => 'Stiliyan Stoyanov',
                'email' => 's.stoyanov@beluga.software',
                'password' => $password,
            ],
            [
                'name' => 'Asen Hristov',
                'email' => 'a.hristov@beluga.software',
                'password' => $password,
            ],
            [
                'name' => 'Nikolay Boyadzhiev',
                'email' => 'n.boyadzhiev@beluga.software',
                'password' => $password,
            ],
        ];

        foreach ($users as $user) {
            $user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            $user->assignRole([$role->id]);
        }
    }
}

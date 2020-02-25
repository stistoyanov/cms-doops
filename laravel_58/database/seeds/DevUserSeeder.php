<?php

use App\Helpers\DataMapper;

use App\User;
use Spatie\Permission\Models\Role;

use Illuminate\Database\Seeder;

class DevUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Dev']);
        $permissions = [];
        foreach (array_keys(DataMapper::$productPermissions) as $key) {
            $permissions[$key] = $key;
        }
        $role->syncPermissions($permissions);

        $password = bcrypt(env('SEED_USER_PASSWORD'));

        $users = [
            [
                'name' => 'Lyusien Lozanov',
                'email' => 'l.lozanov@beluga.software',
                'password' => $password,
            ],
            [
                'name' => 'Jeliu Jelev',
                'email' => 'j.jelev@beluga.software',
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

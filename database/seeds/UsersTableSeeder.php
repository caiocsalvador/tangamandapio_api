<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = DB::table('roles')
                            ->select('id')
                            ->where('name', 'admin')
                            ->first()
                            ->id;

        DB::table('users')->insert([
            'name' => 'admin',
            'password' => bcrypt('123admin456'),
            'role_id'  => $admin_role,
            'email'    => 'admin@admin.com',
        ]);
    }
}

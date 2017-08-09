<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

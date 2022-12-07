<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => 'administrator@gmail.com',
                'username' => 'administrator',
                'password' => Hash::make('administrator', ['rounds' => 13]),
                'phone' => '+62892881239412',
                'roles' => [
                    'admin'
                ]
            ]);
            Admin::create([
                'user_id' => $user->id,
                'name' => 'Administrator',
                'is_active' => true
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('error');
        }

    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            'username' => 'thomas',
            'password' => bcrypt('thomas123'),
            'Last_Name' => 'Reichert',
            'First_Name' => 'Thomas',
            'Street_Address' => '12A Zora Domain',
            'Suburb' => 'Lake Hylia',
            'Postcode' => '3003',
            'Phone_No' => '0401407582',
            'Email_Add' => 'thomasr1987@gmail.com',
            'Position' => 'Senior Admin',
            'Date_Birth' => '1948-12-03'
        ]);
    }
}

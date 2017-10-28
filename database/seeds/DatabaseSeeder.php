<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'username' => 'tom0',
            'password' => Hash::make('tom012'),
            'Last_Name' => 'Perchetta',
            'First_Name' => 'Tomina',
            'Street_Address' => '13 Nils St',
            'Suburb' => 'Nils',
            'Postcode' => '3102',
            'Phone_No' => '0412789789',
            'Email_Add' => 'miniperchiti@nilsmail.net',
            'Position' => 'Staff',
            'Date_Birth' => '1968-06-21'
        ]);
		
		DB::table('staff')->insert([
            'username' => 'tom1',
            'password' => Hash::make('tom123'),
            'Last_Name' => 'Jonas',
            'First_Name' => 'Tom',
            'Street_Address' => '12A Zora Domain',
            'Suburb' => 'Lake Hylia',
            'Postcode' => '3003',
            'Phone_No' => '0401407582',
            'Email_Add' => 'ivorcatt@mail.com',
            'Position' => 'Senior Admin',
            'Date_Birth' => '1948-12-03'
        ]);
		
		DB::table('staff')->insert([
            'username' => 'tom2',
            'password' => Hash::make('tom234'),
            'Last_Name' => 'Pietersen',
            'First_Name' => 'Tomagener',
            'Street_Address' => '14 Peters Ln',
            'Suburb' => 'Poiter',
            'Postcode' => '3202',
            'Phone_No' => '0456234234',
            'Email_Add' => 'tomagener@nilsmail.net',
            'Position' => 'Manager',
            'Date_Birth' => '1992-07-20'
        ]);
		
    }
}

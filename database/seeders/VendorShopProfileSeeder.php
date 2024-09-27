<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::where('email', 'vendor@gmail.com')->first();

        $vendor= new vendor();
        $vendor->banner='uploads/123.jpg';
        $vendor->shop_name='Vendor Shop';
        $vendor->phone='12312312';
        $vendor->email='vendor@gmail.com';
        $vendor->address='Dhaka';
        $vendor->description='Shop description';
        $vendor->user_id=$user->id;
        $vendor->status=1;
        $vendor->save();
    }
}

<?php
namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        Supplier::create([
            'name' => 'National Foods',
            'contact_person' => 'Ahmed Ali',
            'email' => 'ahmed@nationalfoods.com',
            'phone' => '0123456789',
            'address' => '123 Main St, Riyadh'
        ]);

        Supplier::create([
            'name' => 'Global Beverages Co.',
            'contact_person' => 'Sara Khan',
            'email' => 'sara@globalbeverages.com',
            'phone' => '9876543210',
            'address' => '456 Oak Ave, Jeddah'
        ]);
    }
}
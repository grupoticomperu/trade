<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::create([
            'name' => 'unoerp2025dic',
            'domain' => 'uno.erp2025dic.test',
            'database' => 'unoerp2025dic',
        ]);

        Tenant::create([
            'name' => 'doserp2025dic',
            'domain' => 'dos.erp2025dic.test',
            'database' => 'doserp2025dic',
        ]);

        Tenant::create([
            'name' => 'treserp2025dic',
            'domain' => 'tres.erp2025dic.test',
            'database' => 'treserp2025dic',
        ]);

        Tenant::create([
            'name' => 'localhost',
            'domain' => 'erp2025dic.test',
            'database' => 'erp2025dic',
        ]);
    }
}

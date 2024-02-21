<?php

namespace Database\Seeders;

use DDD\Domain\Designs\Design;
// Models
use Illuminate\Database\Seeder;

class DesignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Design::create([
            'organization_id' => 1,
            'title' => 'Design',
            'designer_name' => 'Ryan Harmon',
            'designer_email' => 'ryan@bloomcu.com',
        ]);
    }
}

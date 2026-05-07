<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::create(['name' => 'Figma / UI Design', 'percentage' => 95]);
        Skill::create(['name' => 'Laravel / PHP', 'percentage' => 88]);
        Skill::create(['name' => 'React / JavaScript', 'percentage' => 82]);
        Skill::create(['name' => 'HTML / CSS / Tailwind', 'percentage' => 97]);
        Skill::create(['name' => 'Motion Graphics', 'percentage' => 75]);
        Skill::create(['name' => 'Product Strategy', 'percentage' => 80]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'UI/UX Design',
            'description' => 'Crafting intuitive and visually stunning interfaces that delight users and drive engagement.',
            'icon' => 'fas fa-pencil-ruler'
        ]);

        Service::create([
            'name' => 'Web Development',
            'description' => 'Building robust, scalable full-stack web applications with clean, maintainable code.',
            'icon' => 'fas fa-code'
        ]);

        Service::create([
            'name' => 'Responsive Design',
            'description' => 'Pixel-perfect designs that adapt seamlessly across all devices and screen sizes.',
            'icon' => 'fas fa-mobile-alt'
        ]);

        Service::create([
            'name' => 'Product Design',
            'description' => 'End-to-end product design from concept to launch, blending strategy with aesthetics.',
            'icon' => 'fas fa-layer-group'
        ]);

        Service::create([
            'name' => 'Motion Graphics',
            'description' => 'Bringing interfaces to life with fluid animations and micro-interactions that feel alive.',
            'icon' => 'fas fa-film'
        ]);

        Service::create([
            'name' => 'Content Strategy',
            'description' => 'Developing compelling content frameworks and copy that resonate with target audiences.',
            'icon' => 'fas fa-pen-nib'
        ]);
    }
}

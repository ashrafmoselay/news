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
         //$this->call(CategorySeeder::class);
         //$this->call(NewsSeeder::class);
         //$this->call(SlidersSeeder::class);
         $this->call(GallerySeeder::class);

    }
}

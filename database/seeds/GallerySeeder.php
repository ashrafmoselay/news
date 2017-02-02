<?php

use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        for ($i=0; $i < 8; $i++) { 
        	$n = $i+1;
        	$list [] =  [
            			'title'=>"Egypy Cup $n title here",
		            	'image'=>"default.png",
            			'active'=>1,
            ];
        }
    	DB::table('gallery')->insert($list);
    }
}

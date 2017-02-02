<?php

use Illuminate\Database\Seeder;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        for ($i=0; $i < 5; $i++) { 
        	$n = $i+1;
        	$list [] =  [
            			'title'=>"Egypy Cup $n title here",
		            	'image'=>"default.png",
            			'short_desc'=>"Egypy Cup $n short descrption here and will win africia cup",
            			'active'=>1,
            ];
        }
    	DB::table('sliders')->insert($list);
    }
}

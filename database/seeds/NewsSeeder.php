<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        for ($i=0; $i < 300; $i++) { 
        	$n = $i+1;
        	$list [] =  [
            			'category_id'=>rand(1,8),
            			'title'=>"Egypy Cup $n title here",
		            	'image'=>"default.png",
            			'short_desc'=>"Egypy Cup $n short descrption here and will win africia cup ",
            			'content'=>"Egypt will win the afric cup and all players play and get efforts in all the world Egypt will win the afric cup and all players play and get efforts in all the world Egypt will win the afric cup and all players play and get efforts in all the world Egypt will win the afric cup and all players play and get efforts in all the world Egypt will win the afric cup and all players play and get efforts in all the world Egypt will win the afric cup and all players play and get efforts in all the world Egypt will win the afric cup and all players play and get efforts in all the world",
            			'active'=>1,
            			'show_in_bar'=>0,
            			'views'=>0,
            ];
        }
    	DB::table('news')->insert($list);
    }
}

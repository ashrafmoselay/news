<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
            			'parent_id'=>0,
            			'name'=>"Category name $n",
            			'active'=>1,
            			'sort'=>$n
            ];
        }
    	DB::table('category')->insert($list);
    }
}

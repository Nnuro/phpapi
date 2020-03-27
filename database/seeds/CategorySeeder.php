<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'title' => "Web Design",
                'slug' => "web-design",

            ],

            [
                'title' => "Web Programming",
                'slug' => "web-programming",

            ],

            [
                'title' => "Social Marketing",
                'slug' => "social-marketing",

            ],
            [
                'title' => "Internet",
                'slug' => "internet",

            ],
            [
                'title' => "Photography",
                'slug' => "photography",

            ],


        ]);

        for($post_id=0; $post_id <= 10; $post_id++)
        {
            $category_id = rand(1, 5);

            DB::table('posts')
                    ->where("id", $post_id)
                    ->update(["category_id" => $category_id]);
        }
    }
}

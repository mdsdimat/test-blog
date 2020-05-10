<?php

use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $defaultName = 'Without categories';

        $categories[] = [
            'title' => $defaultName,
            'slug' => Str::slug($defaultName),
            'parent_id' => 0,
        ];

        foreach (range(1, 10) as $categoryNumber) {
            $categoryName = 'Category #'.$categoryNumber;
            $parentId = ($categoryNumber > 5) ? rand(1, 5) : 1;

            $categories[] = [
                'title' => $categoryName,
                'slug' => Str::slug($categoryName),
                'parent_id' => $parentId,
            ];
        }

        DB::table('blog_categories')->insert($categories);
    }
}

<?php

namespace Database\Seeders;

use App\Models\category as ModelsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('category')->delete();
        $cate = ['Activity Books', 'Animals', 'Arts & Literature', 'comedy', 'Classics', 'Contemporary', 'Cultural','Foreign Language','Psychological','Philosophy','science fiction','Historical','Uncategorized','Novels'];
        foreach ($cate as $type) {
            ModelsCategory::create(['category_name' => $type]);
        }
    }
}

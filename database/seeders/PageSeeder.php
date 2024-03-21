<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pages;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $pageData = [
                'category_id'=>1,
                'user_id'=>1,
                // 'parent_page',
                'page_title'=>'About',
                'page_description'=>'this page is about About us',
                'content'=>'<h1>Alex Garry</h1>
                <p>Hi! Im a UX designer living in Zurich, Switzerland.
                    I currently works freelance in Zurich.
                    I help companies to create memorable experiences through user centered design.
                    Im experienced UX designer who loves to develops brands.
                    My value is intersecting logical and emotional concepts.
                    I started working 5 years ago and since then I ve had the opportunity to work with various disciplines such as graphic design,
                    art direction, front-end development,
                    user experience and interface.</p>',
                'meta_title'=>"About page Meta title",
                'meta_description'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima, dolores accusantium? Tempore perspiciatis nisi facere exercitationem aliquid blanditiis? Cumque mollitia unde nostrum omnis quisquam inventore nesciunt natus accusantium quidem deleniti.
                Aperiam quidem, commodi repudiandae fugiat laudantium officiis recusandae soluta corrupti sit odit nihil voluptas ducimus consequuntur incidunt quae amet. Ratione praesentium quod dolor provident delectus fugiat, iure maiores neque eum.',
                'togle_status'=>1,
                // 'featured_image_link',
                'published_status'=>1,
                'make_homepage'=>1,
                'visibility'=>"public",
                // 'published_date_time',
                // 'status',

            ];
            Pages::create($pageData);
    }
}

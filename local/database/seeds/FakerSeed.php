<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FakerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            App\Article::create([
                'title' => $faker->word,
                'content' => $faker->paragraph,
                'image' => 'test.jpg',
                'article_cat_id' => $faker->randomDigit
            ]);
            App\ArticleCat::create([
                'title' => $faker->word,
                'slug' => $faker->word
            ]);
            App\Course::create([
                'title' => $faker->word,
                'slug' => $faker->word,
                'desc' => $faker->paragraph,
                'lessons' => $faker->paragraph,
                'works' => $faker->paragraph,
                'requires' => $faker->paragraph,
                'department_id' => $faker->randomDigit,
                'image' => 'test.jpg',
                'title_en' => $faker->sentence,
                'company' => $faker->word
            ]);
            App\Customer::create([
                'name' => $faker->company,
                'logo' => 'test.jpg'
            ]);
            App\Department::create([
                'title' => $faker->word,
                'slug' => $faker->word,
                'image' => 'test.jpg'
            ]);
            App\Download::create([
                'title' => $faker->word,
                'image' => 'test.jpg',
                'desc' => $faker->paragraph,
                'download_cat_id' => $faker->randomDigit,
                'file' => 'test.pdf',
                'views' => $faker->randomDigit,
                'downloads' => $faker->randomDigit,
            ]);
            App\DownloadCat::create([
                'title' => $faker->word,
                'slug' => $faker->word
            ]);
            App\Job::create([
                'title' => $faker->word,
                'content' => $faker->paragraph,
                'job_cat_id' => $faker->randomDigit,
                'department_id' => $faker->randomDigit,
                'end_date' => $faker->dateTime,
                'featured' => 'no'
            ]);
            App\JobCat::create([
                'title' => $faker->word,
                'slug' => $faker->word
            ]);
            App\Lecturer::create([
                'name' => $faker->name,
                'image' => 'test.jpg',
                'year' => $faker->randomDigit,
                'status' => 'active'
            ]);
            App\News::create([
                'title' => $faker->word,
                'content' => $faker->paragraph,
                'image' => 'test.jpg'
            ]);
            App\OldCourse::create([
                'title' => $faker->word,
                'image1' => 'test.jpg',
                'image2' => 'test.jpg',
                'image3' => 'test.jpg',
                'image4' => 'test.jpg',
                'image5' => 'test.jpg',
                'image6' => 'test.jpg',
                'image7' => 'test.jpg',
                'image8' => 'test.jpg',
                'image9' => 'test.jpg',
                'image10' => 'test.jpg',
                'start_day' => $faker->dayOfMonth,
                'start_month' => $faker->month,
                'start_year' => $faker->year,
                'department_id' => $faker->randomDigit,
                'students' => $faker->randomDigit
            ]);
            App\StudentW::create([
                'name' => $faker->name,
                'image' => 'test.jpg',
                'year' => $faker->year,
                'courses' => $faker->sentence,
                'headline' => $faker->jobTitle,
                'company' => $faker->company
            ]);
            App\Testimonial::create([
                'name' => $faker->name,
                'course' => $faker->word,
                'date_day' => $faker->dayOfMonth,
                'date_month' => $faker->month,
                'date_year' => $faker->year,
                'video' => 'test.mp4'
            ]);
        }
    }
}

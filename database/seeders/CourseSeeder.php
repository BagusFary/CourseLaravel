<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            "title" => "Test Seeder",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem molestiae, eligendi inventore alias quidem quisquam! Inventore rerum tempore rem nobis quia nemo omnis eos aliquid quos maiores, placeat enim doloribus eligendi temporibus repellat. Asperiores assumenda numquam molestias. Possimus excepturi minus iusto dolor saepe ex distinctio dolorem nam iure in recusandae eveniet autem eum sint unde voluptate laboriosam sapiente, quaerat obcaecati vitae nobis quibusdam? Quas necessitatibus magni unde veniam. Pariatur sit deleniti facilis quasi hic, magnam laborum eveniet excepturi, quaerat iusto exercitationem voluptatibus, amet harum doloremque minima. Saepe similique nulla exercitationem, dolorum magnam sed! Sed rem ipsa repellat unde dolor adipisci.",
            "price" => 100000,
            "thumbnail" => 'courseimageandvideo/3.jpg',
            "video" => 'courseimageandvideo/Laravel in 100 Seconds.mp4'
        ]);
        
        storeAs('video','Laravel in 100 Seconds.mp4');
        
        $request->file('thumbnail')->storeAs('thumbnail', $thumbnailName);
        $request->file('video')-> storeAs('video',$videoName);
    }
}


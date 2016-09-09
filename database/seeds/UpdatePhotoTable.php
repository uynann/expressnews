<?php

use Illuminate\Database\Seeder;
use App\Photo;

class UpdatePhotoTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $photos = Photo::all();
        foreach($photos as $photo) {
            $photo->update(['user_id' => 1]);
        }
    }
}

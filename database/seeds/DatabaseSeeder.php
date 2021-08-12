<?php

use App\organizer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $organizers = organizer::get();
        foreach($organizers as $organizer){
            if($organizer->slug == 'demo1'){
                $organizer->password_hash = bcrypt('demopass1');
            }else{
                $organizer->password_hash = bcrypt('demopass2');
            }
            $organizer->update();
        }
    }
}

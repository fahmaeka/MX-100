<?php

use Illuminate\Database\Seeder;
use App\RankConfiguration;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('RanksTableSeeder');

        $this->command->info('Ranks table seeded!');
    }
}

class RanksTableSeeder extends Seeder {

    public function run()
    {
        DB::table('rank_configuration')->delete();

        $all_data = [ ['name' => 'A', 'point' => 40], ['name' => 'B', 'point' => 20] ];
        foreach ($all_data as $key => $value) 
        {
            RankConfiguration::insert($value);
        }
    }

}

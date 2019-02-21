<?php

use Illuminate\Database\Seeder;
use App\Group;
class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Group::create(['name' => 'KSA']);
      Group::create(['name' => 'USA']);
      Group::create(['name' => 'General']);
    }
}

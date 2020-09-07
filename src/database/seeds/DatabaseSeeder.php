<?php

use App\Department;
use App\Subject;
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
        factory(Department::class, 10)->create();
        factory(Subject::class, 100)->create();
    }
}

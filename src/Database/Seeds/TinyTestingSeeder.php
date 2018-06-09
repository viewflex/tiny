<?php

namespace Viewflex\Tiny\Database\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * For seeding Tiny test data via artisan command or static method seed().
 */
class TinyTestingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * Note: These seeds are for testing.
     *
     * @return void
     */
    public function run()
    {
        $this::seed(config('tiny.tables'));
    }

    /**
     * Seed the database with test data, including 'users' table unless specified otherwise.
     *
     * @param array $tables
     * @param bool $seed_users_tables
     */
    public static function seed($tables = [], $seed_users_tables = true)
    {

        if ($seed_users_tables) {

            // ----------------------------------------
            // Users
            // ----------------------------------------

            DB::table($tables['users'])->insert(['id' => 1, 'username' => 'Admin']);
            DB::table($tables['users'])->insert(['id' => 2, 'username' => 'Subscriber']);

        }


    }
    
}

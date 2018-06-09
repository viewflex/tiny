<?php

namespace Viewflex\Tiny\Database\Schema;


class TinyTestData
{
    /**
     * Create the test database and tables.
     *
     * @param array $tables
     * @return void
     */
    public static function create($tables)
    {
        // Migrate
        TinySchema::create($tables);
    }

    /**
     * Drop the test database and tables.
     *
     * @param array $tables
     * @return void
     */
    public static function drop($tables)
    {
        // Drop the tables that we created.
        TinySchema::drop($tables);
        
    }
    
}
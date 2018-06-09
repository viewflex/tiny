<?php

namespace Viewflex\Tiny\Database\Schema;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TinySchema
{
    /**
     * Run the migrations to create Tiny schema for testing or production.
     * 
     * @param array $tables
     */
    public static function create($tables = [])
    {

        // ----------------------------------------
        // Urls
        // ----------------------------------------

        Schema::create($tables['urls'], function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash', 32)->nullable();
            $table->string('url', 255);

            $table->index('hash');
            $table->index('url');
        });
        
    }

    /**
     * Reverse the migration, dropping user table too if specified.
     * 
     * @param array $tables
     */
    public static function drop($tables = [])
    {
        Schema::drop($tables['urls']);
    }
    
    
}

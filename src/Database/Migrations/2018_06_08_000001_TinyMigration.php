<?php


use Illuminate\Database\Migrations\Migration;
use Viewflex\Tiny\Database\Schema\TinySchema;

/**
 * Creates the database table for the Viewflex\Tiny package.
 */
class TinyMigration extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        TinySchema::create(config('tiny.tables'));
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        TinySchema::drop(config('tiny.tables'));
    }
}

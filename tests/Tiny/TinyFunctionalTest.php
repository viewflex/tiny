<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Viewflex\Tiny\Database\Schema\TinyTestData;
use Viewflex\Tiny\Queries\TinyQuery as Query;
use Viewflex\Tiny\Services\TinyService as Tiny;

/**
 * Test functionality of the package service layer.
 */
class TinyFunctionalTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var Tiny
     */
    protected $tiny;
    
    public function setUp(): void
    {
        parent::setUp();
        TinyTestData::create(config('tiny.tables'));
        $this->tiny = new Tiny(new Query);
    }
    
    public function test_can_add_and_lookup_url()
    {
        $hash = $this->tiny->addUrl('http://example.com');
        $this->assertNotNull($hash);

        $url = $this->tiny->getUrlByHash($hash);
        $this->assertEquals('http://example.com', $url);
    }

}

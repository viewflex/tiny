<?php

namespace Viewflex\Tiny\Queries;


use Illuminate\Support\Facades\DB;
use Viewflex\Tiny\Contracts\TinyQueryInterface;
use Viewflex\Tiny\Exceptions\TinyException;
use Viewflex\Tiny\Utility\TinyCachingTrait;
use Viewflex\Tiny\Utility\Encoder;

class TinyQuery implements TinyQueryInterface
{
    use TinyCachingTrait;

    /**
     * Returns url found by hash, or null.
     *
     * @param string $hash
     * @return string|null
     */
    public function getUrlByHash($hash)
    {
        $getUrl = function($hash) {
            $result = DB::table(config('tiny.tables.urls'))->where('hash', $hash)->first();
            return $result ? $result->url : null;
        };

        return self::cacheQuery('URL lookup', $getUrl, $hash);
    }

    /**
     * Returns hash found by url, or null.
     *
     * @param string $url
     * @return string|null
     */
    public function getHashByUrl($url)
    {
        $result = DB::table(config('tiny.tables.urls'))->where('url', $url)->first();
        return $result ? $result->hash : null;
    }
    
    /**
     * Creates url record if not existing, returns hash of id.
     *
     * @param string $url
     * @return string $hash
     * @throws TinyException
     */
    public function addUrl($url)
    {

        if (! $url) {
            throw new TinyException('No URL specified.');
        }
        
        if ($hash = $this->getHashByUrl($url)) {
            return $hash;
        }
        
        $id = DB::table(config('tiny.tables.urls'))->insertGetId([
            'url'   => $url
        ]);

        if (! $id) {
            throw new TinyException('Record could not be created.');
        }
        
        $hash = (new Encoder)->encode($id);

        $affected_rows = DB::table(config('tiny.tables.urls'))->where('id', $id)->update([
            'hash' => $hash
        ]);

        if (! $affected_rows) {
            throw new TinyException('Record could not be updated.');
        }

        return $hash;
    }

}

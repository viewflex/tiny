<?php

namespace Viewflex\Tiny\Contracts;


use Viewflex\Tiny\Exceptions\TinyException;

interface TinyServiceInterface
{
    /**
     * Returns url found by hash, or null.
     *
     * @param string $hash
     * @return string|null
     */
    public function getUrlByHash($hash);

    /**
     * Returns hash found by url, or null.
     *
     * @param string $url
     * @return string|null
     */
    public function getHashByUrl($url);

    /**
     * Creates url record if not existing, returns hash of id.
     *
     * @param string $url
     * @return string $hash
     * @throws TinyException
     */
    public function addUrl($url);
    
}

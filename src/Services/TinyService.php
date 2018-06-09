<?php

namespace Viewflex\Tiny\Services;


use Viewflex\Tiny\Contracts\TinyQueryInterface;
use Viewflex\Tiny\Contracts\TinyServiceInterface;
use Viewflex\Tiny\Exceptions\TinyException;

class TinyService implements TinyServiceInterface
{
    /**
     * @var TinyQueryInterface
     */
    protected $query;
    
    
    public function __construct(TinyQueryInterface $query)
    {
        $this->query = $query;
    }

    /**
     * Returns url found by hash, or null.
     *
     * @param string $hash
     * @return string|null
     */
    public function getUrlByHash($hash)
    {
        return $this->query->getUrlByHash($hash);
    }

    /**
     * Returns hash found by url, or null.
     *
     * @param string $url
     * @return string|null
     */
    public function getHashByUrl($url)
    {
        return $this->query->getHashByUrl($url);
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
        return $this->query->addUrl($url);
    }
    
}

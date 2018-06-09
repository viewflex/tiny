<?php

namespace Viewflex\Tiny\Utility;


use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;
use Viewflex\Tiny\Exceptions\TinyException;

trait TinyCachingTrait
{

    /**
     * Returns a unique query identifier for use as a cache key.
     *
     * @param string $query_name
     * @param int $value
     * @return string
     */
    static public function cacheKey($query_name, $value)
    {
        return md5('notifier_'.$query_name.'_'.strval($value));
    }

    /**
     * Using cache if specified, perform query,
     * with optional value passed as argument.
     * Provide a unique descriptor for key.
     *
     * @param string $descriptor
     * @param Closure $function
     * @param null|mixed $value
     * @return mixed
     * @throws TinyException
     */
    static public function cacheQuery($descriptor, $function, $value = null)
    {
        $cache = config('tiny.caching');

        if($cache['active']) {
            $key = self::cacheKey($descriptor, $value);

            if (Cache::has($key)) {
                $result = unserialize(Cache::get($key));
            } else {

                $result = $function($value);

                if (!Cache::add($key, serialize($result),
                    Carbon::now()->addMinutes($cache['minutes']))) {
                    throw new TinyException('Unable to add '.$descriptor.' results to cache.');
                }
            }

        } else {
            $result = $function($value);
        }

        return $result;
    }
    
}

<?php
// 代码生成时间: 2025-09-23 14:00:44
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Psr\SimpleCache\InvalidArgumentException;

// CacheManager class to handle cache operations
class CacheManager {
    /**
     * Cache key prefix
     *
     * @var string
     */
    protected $cacheKeyPrefix;

    /**
     * Constructor to initialize cache key prefix
     *
     * @param string $cacheKeyPrefix
     */
    public function __construct($cacheKeyPrefix = '') {
        $this->cacheKeyPrefix = $cacheKeyPrefix;
    }

    /**
     * Retrieve data from cache with the specified key
     *
     * @param string $key
     * @return mixed
     */
    public function get($key) {
        try {
            $fullKey = $this->cacheKeyPrefix . $key;
            return Cache::get($fullKey);
        } catch (InvalidArgumentException $e) {
            Log::error("Cache key error: {$e->getMessage()}");
            return null;
        }
    }

    /**
     * Store data in cache with the specified key and lifetime
     *
     * @param string $key
     * @param mixed $value
     * @param \DateTimeInterface|\DateInterval|int $ttl
     * @return bool
     */
    public function put($key, $value, $ttl) {
        try {
            $fullKey = $this->cacheKeyPrefix . $key;
            return Cache::put($fullKey, $value, $ttl);
        } catch (InvalidArgumentException $e) {
            Log::error("Cache put error: {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Remove data from cache with the specified key
     *
     * @param string $key
     * @return bool
     */
    public function forget($key) {
        try {
            $fullKey = $this->cacheKeyPrefix . $key;
            return Cache::forget($fullKey);
        } catch (InvalidArgumentException $e) {
            Log::error("Cache forget error: {$e->getMessage()}");
            return false;
        }
    }
}

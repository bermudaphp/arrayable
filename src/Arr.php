<?php

namespace Bermuda;

/**
 * Class Arr
 * @package App
 */
final class Arr
{
    private function __construct()
    {
    }

    /**
     * @param array $array
     * @param $offset
     * @param null $default
     * @return mixed|null
     */
    public static function pull(array &$array, $offset, $default = null)
    {
        $value = $array[$offset] ?? $default;
        unset($array[$offset]);
        
        return $value;
    }

    /**
     * @param array $array
     * @param string|string[] $offsets
     * @return array
     */
    public static function only(array $array, $offsets): array
    {
        $only = [];
        
        foreach (is_array($offsets)
                     ? $offsets : [$offsets] as $offset)
        {
            if (array_key_exists($offset, $array))
            {
                $only[$offset] = $array[$offset];
            }
        }
        
        return $only;
    }

    /**
     * @param array $array
     * @param string|string[] $offsets
     * @return void
     */
    public static function remove(array &$array, $offsets): void
    {
        foreach (is_array($offsets)
                     ? $offsets : [$offsets] as $offset)
        {
            unset($array[$offset]);
        }
    }

    /**
     * @param string $subject
     * @param string $separator
     * @param int|null $limit
     * @return array
     */
    public static function explode(string $subject, string $separator, ?int $limit = null): array
    {
        return explode($separator, $subject, $limit);
    }

    /**
     * @param array $array
     * @param callable $callback
     * @return array
     */
    public static function map(array $array, callable $callback): array
    {
        return array_map($callback, $array);
    }

    /**
     * @param array $array
     * @param callable $callback
     * @return array
     */
    public static function filter(array $array, callable $callback): array
    {
        return array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @param array $array
     * @param string|string[] $offsets
     * @return array
     */
    public static function except(array $array, $offsets): array
    {
        foreach (is_array($offsets)
                     ? $offsets : [$offsets] as $offset)
        {
            unset($array[$offset]);
        }

        return $array;
    }
}

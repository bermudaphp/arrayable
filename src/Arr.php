<?php

namespace Bermuda;

final class Arr
{
    /**
     * @param $var
     * @return array
     */
    public static function toArray($var): array
    {
        return to_array($var);
    }

    /**
     * @param array|\ArrayAccess $accessible
     * @param $offset
     * @param null $default
     * @return mixed|null
     */
    public static function pull(array|\ArrayAccess &$accessible, $offset, $default = null)
    {
        $value = $array[$offset] ?? $default;
        unset($array[$offset]);
        
        return $value;
    }
    
    /**
     * @param array|\ArrayAccess $accessible
     * @param string[]|int[] $offsets
     * @param null $default
     * @return array|\ArrayAccess
     */
    public static function pullAll(array|\ArrayAccess &$accessible, array $offsets, $default = null): array|\ArrayAccess
    {
        $vars = [];
        foreach($offsets as $offset) {
            $vars[$offset] = self::pull($array, $offset, is_array($default) ? $default[$offset] ?? null : $default);
        }
        
        return $vars;
    } 

    /**
     * @param array|ArrayAccess $accessible
     * @param string|int|int[]|string[] $offsets
     * @return array|\ArrayAccess
     */
    public static function only(array|\ArrayAccess $accessible, string|int|array $offsets): array|\ArrayAccess
    {
        foreach (to_array($offsets) as $offset) {
            if (array_key_exists($offset, $array)) {
                $only[$offset] = $array[$offset];
            }
        }
        
        return $only ?? [];
    }

    /**
     * @param array|\ArrayAccess $accessible
     * @param string|string[] $offsets
     * @return array|\ArrayAccess
     */
    public static function remove(array|\ArrayAccess &$accessible, string|array $offsets): array|\ArrayAccess
    {
        foreach (to_array($offsets) as $offset) {
            unset($array[$offset]);
        }

        return $array;
    }

    /**
     * @param string $subject
     * @param string $separator
     * @param int|null $limit
     * @return array
     */
    public static function explode(string $subject, string $separator = ',', ?int $limit = null): array
    {
        return explode($separator, $subject, $limit);
    }

    /**
     * @param array $array
     * @param callable $callback
     * @return array
     */
    public static function map(array &$array, callable $callback): array
    {
        return $array = array_map($callback, $array);
    }

    /**
     * @param array $array
     * @param callable $callback
     * @return array
     */
    public static function filter(array &$array, callable $callback): array
    {
        return $array = array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @param array|\ArrayAccess $accessible
     * @param string|int|string[]|int[] $offsets
     * @return array|ArrayAccess
     */
    public static function except(array|\ArrayAccess $accessible, string|int|array $offsets): array|ArrayAccess
    {
        return self::remove($array, $offsets);
    }
}

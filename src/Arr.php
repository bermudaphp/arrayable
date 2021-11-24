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
     * @param $var
     * @return array
     */
    public static function toArray($var): array
    {
        if (is_array($var)) {
            return $var;
        }

        if ($var instanceof Arrayable) {
            return $var->toArray();
        }

        if (is_iterable($var)) {
            return iterator_to_array($var);
        }

        return [$var];
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
     * @param string[] $offsets
     * @param null $default
     * @return array
     */
    public static function pullAll(array &$array, array $offsets, $default = null): array
    {
        $vars = [];
        foreach($offsets as $offset) {
            $vars[$offset] = self::pull($array, $offset, is_array($default) ? $default[$offset] ?? null : $default);
        }
        
        return $vars;
    } 

    /**
     * @param array $array
     * @param string|string[] $offsets
     * @return array
     */
    public static function only(array $array, string|array $offsets): array
    {
        foreach (self::toArray($offsets) as $offset) {
            if (array_key_exists($offset, $array)) {
                $only[$offset] = $array[$offset];
            }
        }
        
        return $only ?? [];
    }

    /**
     * @param array $array
     * @param string|string[] $offsets
     * @return array
     */
    public static function remove(array &$array, string|array $offsets): array
    {
        foreach (self::toArray($offsets) as $offset) {
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
     * @param array $array
     * @param string|string[] $offsets
     * @return array
     */
    public static function except(array $array, string|array $offsets): array
    {
        return self::remove($array, $offsets);
    }
}

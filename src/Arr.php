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
        
        foreach ((array) $offsets as $offset)
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
     * @return array
     */
    public static function except(array $array, $offsets): array
    {
        foreach ((array) $offsets as $offset)
        {
            unset($array[$offset]);
        }

        return $array;
    }
}

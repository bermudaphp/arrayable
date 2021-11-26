<?php

namespace Bermuda;

/**
 * @param $var
 * @return array
 */
function to_array($var): array
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
 * @param array|\ArrayAccess $accessible
 * @param string|int $offset
 * @param null $default
 * @return mixed
 */
function array_pull(array|\ArrayAccess &$accessible, string|int $offset, $default = null): mixed
{
    $value = $accessible[$offset] ?? $default;
    unset($array[$offset]);

    return $value;
}

/**
 * @param array|\ArrayAccess $accessible
 * @param string[]|int[] $offsets
 * @param null $default
 * @return array
 */
function array_pull_all(array|\ArrayAccess &$accessible, array $offsets, $default = null): array
{
    $vars = [];
    foreach($offsets as $offset) {
        $vars[$offset] = array_pull($accessible, $offset, is_array($default) ? $default[$offset] ?? null : $default);
    }

    return $vars;
}

/**
 * @param array|\ArrayAccess $accessible
 * @param int|string $key
 * @return bool
 */
function array_key_exists(array|\ArrayAccess $accessible, int|string $key): bool
{
    return $accessible instanceof \ArrayAccess ? $accessible->offsetExists($key) : \array_key_exists($key, $accessible);
}

/**
 * @param array|\ArrayAccess $accessible
 * @param string|int|int[]|string[] $offsets
 * @return array
 */
function array_only(array|\ArrayAccess $accessible, string|int|array $offsets): array
{
    foreach (to_array($offsets) as $offset) {
        if (array_key_exists($accessible, $offset)) {
            $only[$offset] = $accessible[$offset];
        }
    }

    return $only ?? [];
}

/**
 * @param array|\ArrayAccess $accessible
 * @param string|int|int[]|string[] $offsets
 * @return array|\ArrayAccess
 */
function array_remove(array|\ArrayAccess &$accessible, string|int|array $offsets): array|\ArrayAccess
{
    foreach (to_array($offsets) as $offset) {
        unset($accessible[$offset]);
    }

    return $accessible;
}

/**
 * @param string $subject
 * @param string $separator
 * @param int|null $limit
 * @return array
 */
function explode(string $subject, string $separator = ',', ?int $limit = null): array
{
    return explode($separator, $subject, $limit);
}

/**
 * @param array $array
 * @param callable $callback
 * @return array
 */
function array_map(array &$array, callable $callback): array
{
    return $array = \array_map($callback, $array);
}

/**
 * @param array $array
 * @param callable $callback
 * @return array
 */
function array_filter(array &$array, callable $callback): array
{
    return $array = \array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
}

/**
 * @param array|\ArrayAccess $accessible
 * @param string|int|int[]|string[] $offsets
 * @return array|\ArrayAccess
 */
function array_except(array|\ArrayAccess $accessible, string|int|array $offsets): array|\ArrayAccess
{
    if ($accessible instanceof \ArrayAccess) {
        $accessible = clone $accessible;
    }

    return array_remove($accessible, $offsets);
}

/**
 * @param array $array
 * @return mixed
 */
function array_end(array $array): mixed
{
    if ($array === []) {
        throw new \RuntimeException('Array is empty');
    }
    
    return end($array);
}

/**
 * @param array $array
 * @return mixed
 */
function array_start(array $array): mixed
{
    if ($array === []) {
        throw new \RuntimeException('Array is empty');
    }
    
    return reset($array);
}

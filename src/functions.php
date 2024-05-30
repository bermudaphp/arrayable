<?php

namespace Bermuda\Stdlib;

function to_array(mixed $var): array
{
    if ($var instanceof Arrayable) return $var->toArray();
    if ($var instanceof \IteratorAggregate) return \iterator_to_array($var->getIterator());
    if ($var instanceof \Iterator) return \iterator_to_array($var);
    if (is_object($var)) return \get_object_vars($var);
    if (is_array($var)) return $var;
    if ($var === null) return [];
    
    return [$var];
}

function array_last(array $array): mixed
{
    return $array[\array_key_last($array)];
}

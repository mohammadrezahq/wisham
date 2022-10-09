<?php

namespace App\Types;

class Types
{
    public static $registered_types = [
        'book' => \App\Types\Book::class,
        'product' => \App\Types\Product::class,
        'movie' => \App\Types\Movie::class,
        'todo' => \App\Types\Todo::class,
    ];

    public static function get($type)
    {
        $types = self::$registered_types;

        if (!key_exists($type, $types)) {
            return null;
        }

        $instance = new $types[$type]();

        return $instance;
    }

    public static function has(String $type)
    {
        return key_exists($type, self::$registered_types);
    }

    public static function allTypes()
    {
        return array_keys(self::$registered_types);
    }

    public static function all()
    {
        $types = array();

        foreach (self::$registered_types as $type => $class) {
            $instance = new $class();
            $types[$type] = $instance->title;
        }

        return $types;
    }
}

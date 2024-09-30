<?php

if (!function_exists('env')) {
    /**
     * @param string|null $name
     * @param mixed $default
     * @return mixed
     */
    function env(string $name = null, mixed $default = null): mixed
    {
        if ($name === null) {
            return $_ENV;
        }

        return $_ENV[$name] ??= $default;
    }
}

if (!function_exists('dd')) {
    /**
     * @param ...$vars
     * @return void
     */
    function dd(...$vars): void
    {
        echo "<pre>";
        call_user_func_array('var_dump', $vars);
        echo "</pre>";
        exit;
    }
}
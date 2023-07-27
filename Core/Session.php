<?php

namespace Core;
class Session
{
    /**
     * @param $key
     * @param $value
     * @return void
     */
    public static function put($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public static function get($key, $default = null): mixed
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public static function has($key, $value): bool
    {
       return (bool) static::get($key);
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public static function flash($key, $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    /**
     * @return void
     */
    public static function unfalsh(): void
    {
        unset($_SESSION['_flash']);
    }

    /**
     * @return void
     */
    public static  function flush(): void
    {
        $_SESSION = [];
    }

    public static function destroy(): void
    {
        static::flush();
        session_destroy();

        // Remove cookie completely
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}
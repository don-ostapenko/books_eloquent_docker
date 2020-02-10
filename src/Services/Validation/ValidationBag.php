<?php

namespace App\Services\Validation;

trait ValidationBag
{

    /**
     * @param $value
     * @return bool
     */
    public function required(array $value): bool
    {
        return !!$value[0];
    }

    /**
     * @param array $value
     * @return bool
     */
    public function numeric(array $value): bool
    {
        return is_numeric($value[0]);
    }

    /**
     * @param $value
     * @return bool
     */
    public function email(array $value): bool
    {
        return strpos($value[0], '@') !== false;
    }

    /**
     * @param $value
     * @return bool
     */
    public function boolean(array $value): bool
    {
        return $value[0] == 1 || $value[0] == 0;
    }

    /**
     * @param array $value
     * @return bool
     */
    public function url(array $value): bool
    {
        return filter_var($value[0], FILTER_VALIDATE_URL);
    }

    /**
     * @param array $value
     * @return bool
     */
    public function length(array $value): bool
    {
        return strlen($value[0]) == $value[2];
    }

    /**
     * @param array $value
     * @return bool
     */
    public function string(array $value): bool
    {
        return is_string($value[0]);
    }

    /**
     * @param $value
     * @return bool
     */
    public function skip(array $value): bool
    {
        return true;
    }
}
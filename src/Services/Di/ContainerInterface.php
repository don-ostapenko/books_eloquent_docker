<?php

namespace App\Services\Di;

use App\Exceptions\ParameterNotFoundException;

/**
 * Interface ContainerInterface
 * @package App\Services\Di
 */
interface ContainerInterface
{
    /**
     * Retrieve a parameter from the container.
     *
     * @param string $name The parameter name.
     *
     * @return mixed The parameter.
     *
     * @throws ParameterNotFoundException On failure.
     */
    public function getParameter($name);

    /**
     * Check to see if the container has a parameter.
     *
     * @param string $name The parameter name.
     *
     * @return bool True if the container has the parameter, false otherwise.
     */
    public function hasParameter($name);
}
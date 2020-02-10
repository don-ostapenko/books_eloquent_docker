<?php

namespace App\Services\Di;

use App\Exceptions\ServiceNotFoundException;
use App\Exceptions\ParameterNotFoundException;
use App\Exceptions\DiContainerException;
use App\Services\Di\Reference\ServiceReference;
use App\Services\Di\Reference\ParameterReference;
use ReflectionException;


class DiContainer implements ContainerInterface
{
    /**
     * @var array
     */
    private $services;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $serviceStore;

    /**
     * DiContainer constructor.
     * @param array $services
     * @param array $parameters
     */
    public function __construct(array $services = [], array $parameters = [])
    {
        $this->services = $services;
        $this->parameters = $parameters;
        $this->serviceStore = [];
    }

    /**
     * @param string $name
     * @return mixed
     * @throws
     */
    public function get(string $name)
    {
        if (!$this->has($name)) {
            throw new ServiceNotFoundException(sprintf('The service does not exist: %s', $name));
        }

        if (!isset($this->serviceStore[$name])) {
            $this->serviceStore[$name] = $this->createService($name);
        }

        return $this->serviceStore[$name];
    }

    /**
     * @param string $name
     * @return bool|mixed
     */
    public function has(string $name): ?bool
    {
        return isset($this->services[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function getParameter($name)
    {
        $tokens = explode('.', $name);
        $context = $this->parameters;

        while (null !== ($token = array_shift($tokens))) {
            if (!isset($context[$token])) {
                throw new ParameterNotFoundException(sprintf('The parameter does not exist: %s', $name));
            }

            $context = $context[$token];
        }

        return $context;
    }

    /**
     * {@inheritDoc}
     */
    public function hasParameter($name)
    {
        try {
            $this->getParameter($name);
        } catch (ParameterNotFoundException $exception) {
            return false;
        }

        return true;
    }

    /**
     * Attempt to create a service.
     *
     * @param string $name The service name.
     *
     * @return mixed The created service.
     *
     * @throws DiContainerException
     * @throws ParameterNotFoundException
     * @throws ServiceNotFoundException
     * @throws ReflectionException
     */
    private function createService($name)
    {
        $entry = &$this->services[$name];

        if (!is_array($entry) || !isset($entry['class'])) {
            throw new DiContainerException(sprintf('%s service entry must be an array containing a \'class\' key', $name));
        } elseif (!class_exists($entry['class'])) {
            throw new DiContainerException(sprintf('%s service class does not exist: %s', $name, $entry['class']));
        } elseif (isset($entry['lock'])) {
            throw new DiContainerException(sprintf('%s service contains a circular reference', $name));
        }

        $entry['lock'] = true;

        $arguments = isset($entry['arguments']) ? $this->resolveArguments($entry['arguments']) : [];

        $reflector = new \ReflectionClass($entry['class']);
        $service = $reflector->newInstanceArgs($arguments);

        if (isset($entry['calls'])) {
            $this->initializeService($service, $name, $entry['calls']);
        }

        return $service;
    }

    /**
     * Resolve argument definitions into an array of arguments.
     *
     * @param array $argumentDefinitions The service arguments definition.
     *
     * @return array The service constructor arguments.
     *
     * @throws ParameterNotFoundException
     * @throws ServiceNotFoundException
     */
    private function resolveArguments(array $argumentDefinitions)
    {
        $arguments = [];

        foreach ($argumentDefinitions as $argumentDefinition) {
            if ($argumentDefinition instanceof ServiceReference) {
                $argumentServiceName = $argumentDefinition->getName();

                $arguments[] = $this->get($argumentServiceName);
            } elseif ($argumentDefinition instanceof ParameterReference) {
                $argumentParameterName = $argumentDefinition->getName();

                $arguments[] = $this->getParameter($argumentParameterName);
            } else {
                $arguments[] = $argumentDefinition;
            }
        }

        return $arguments;
    }

    /**
     * Initialize a service using the call definitions.
     *
     * @param object $service The service.
     * @param string $name The service name.
     * @param array $callDefinitions The service calls definition.
     *
     * @throws DiContainerException On failure.
     * @throws ParameterNotFoundException
     * @throws ServiceNotFoundException
     */
    private function initializeService($service, $name, array $callDefinitions)
    {
        foreach ($callDefinitions as $callDefinition) {
            if (!is_array($callDefinition) || !isset($callDefinition['method'])) {
                throw new DiContainerException(sprintf('%s service calls must be arrays containing a \'method\' key', $name));
            } elseif (!is_callable([$service, $callDefinition['method']])) {
                throw new DiContainerException(sprintf('%s service asks for call to uncallable method: %s', $name, $callDefinition['method']));
            }

            $arguments = isset($callDefinition['arguments']) ? $this->resolveArguments($callDefinition['arguments']) : [];

            call_user_func_array([$service, $callDefinition['method']], $arguments);
        }
    }
}
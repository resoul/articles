<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use ReflectionClass;
use ReflectionException;

class Container
{
    /**
     * @var array<string, callable>
     */
    private array $bindings = [];

    /**
     * @var array<string, object>
     */
    private array $instances = [];

    public function bind(string $className, callable $callable): void
    {
        $this->bindings[$className] = $callable;
    }

    public function boot(string $className, callable $callable): void
    {
        $this->bind($className, function () use ($className, $callable) {
            if (!isset($this->instances[$className])) {
                $this->instances[$className] = $callable($this);
            }

            return $this->instances[$className];
        });
    }

    public function make(string $className): object
    {
        if (isset($this->bindings[$className])) {
            return ($this->bindings[$className])($this);
        }

        return $this->resolve($className);
    }

    private function resolve(string $className): object
    {
        try {
            $reflection = new ReflectionClass($className);
        } catch (ReflectionException) {
            throw new \RuntimeException("Class $className not found");
        }

        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            $instance = new $className();
            $this->injectProperties($instance, $reflection);
            return $instance;
        }

        $params = $constructor->getParameters();
        $dependencies = [];

        foreach ($params as $param) {
            $type = $param->getType();

            if ($type === null || $type->isBuiltin()) {
                if ($param->isDefaultValueAvailable()) {
                    $dependencies[] = $param->getDefaultValue();
                } else {
                    throw new \RuntimeException(
                        "Cannot resolve parameter \${$param->getName()} in $className"
                    );
                }

                continue;
            }

            $dependencies[] = $this->make($type->getName());
        }

        try {
            $instance = $reflection->newInstanceArgs($dependencies);
        } catch (ReflectionException) {
            throw new \RuntimeException("Cannot create class $className");
        }

        $this->injectProperties($instance, $reflection);

        return $instance;
    }

    private function injectProperties(object $instance, ReflectionClass $reflection): void
    {
        $class = $reflection;

        while ($class !== false) {
            foreach ($class->getProperties() as $property) {
                $attributes = $property->getAttributes(Inject::class);

                if (empty($attributes)) {
                    continue;
                }

                $type = $property->getType();

                if ($type === null || $type->isBuiltin()) {
                    throw new \RuntimeException(
                        "Cannot inject built-in type for \${$property->getName()}"
                    );
                }

                $property->setAccessible(true);
                $property->setValue($instance, $this->make($type->getName()));
            }

            $class = $class->getParentClass();
        }
    }
}

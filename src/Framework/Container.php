<?php

declare(strict_types=1);

namespace Framework;

use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{
    private array $definitions = [];
    private array $resolved = [];

    public function addDefinitions(array $newDefinitions)
    {
        $this->definitions = [...$this->definitions, ...$newDefinitions];
        // the below is the same as the above only that the above is with the spread operator seen as ...
        // $this->definitions = array_merge($this->definitions, $newDefinitions);
        // dd($this->definitions["Framework\TemplateEngine"]());
    }

    public function resolve(string $className)
    {
        // dd($className);
        $reflectionClass = new ReflectionClass($className);
        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable");
        }

        $constructor = $reflectionClass->getConstructor();
        if (!$constructor) {
            return new $className();
        }

        $params = $constructor->getParameters();

        if (count($params) === 0) {
            return new $className();
        }

        $dependencies = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolve class {$className} because param {$name} is missing a type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve class {$className} because invalid param name.");
            }

            $dependencies[] = $this->get($type->getName());
        }
        // for instantiating the class called by the reflectionClass and then pass on the dependencies
        // dd($dependencies);
        // dd($reflectionClass->newInstanceArgs($dependencies));
        return $reflectionClass->newInstanceArgs($dependencies);
    }

    // responsible for instantiating the dependencies
    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} does not exist in container.");
        }

        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $factory = $this->definitions[$id];
        // dd($this->definitions["Framework\TemplateEngine"]());
        $dependency = $factory();

        $this->resolved[$id] = $dependency;

        return $dependency;
    }
}

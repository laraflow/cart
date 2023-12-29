<?php

namespace Laraflow\Cart\Traits;
use BadMethodCallException;
use Illuminate\Support\Arr;

trait Componentable
{
    /**
     * The registered components.
     *
     * @var array
     */
    protected static array $components = [];

    /**
     * Register a custom component.
     *
     * @param    $name
     * @param array $signature
     * @return void
     */
    public static function component($name, array $signature): void
    {
        static::$components[$name] = compact( 'signature');
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call(string $method, array $parameters)
    {
        if (static::hasComponent($method)) {
            return $this->renderComponent($method, $parameters);
        }

        throw new BadMethodCallException("Method {$method} does not exist.");
    }

    /**
     * Check if a component is registered.
     *
     * @param $name
     * @return bool
     */
    public static function hasComponent($name): bool
    {
        return isset(static::$components[$name]);
    }

    /**
     * Render a custom component.
     *
     * @param    $name
     * @param  array  $arguments
     * @return View|HtmlString
     */
    protected function renderComponent($name, array $arguments)
    {
        $component = static::$components[$name];
        $data = $this->getComponentData($component['signature'], $arguments);

//        return ;
    }

    /**
     * Prepare the component data, while respecting provided defaults.
     *
     * @param  array  $signature
     * @param  array  $arguments
     * @return array
     */
    protected function getComponentData(array $signature, array $arguments): array
    {
        $data = [];

        $i = 0;
        foreach ($signature as $variable => $default) {
            // If the "variable" value is actually a numeric key, we can assume that
            // no default had been specified for the component argument and we'll
            // just use null instead, so that we can treat them all the same.
            if (is_numeric($variable)) {
                $variable = $default;
                $default = null;
            }

            $data[$variable] = Arr::get($arguments, $i, $default);

            $i++;
        }

        return $data;
    }
}

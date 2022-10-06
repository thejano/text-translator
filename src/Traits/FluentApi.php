<?php
/**
 * Fluent interface is an object-oriented API whose design relies extensively on method chaining. Its goal is to increase code legibility.
 * Each method should start with _ in order to be called statically and non statically.
 * Credits: https://github.com/danielefavi/php-fluent-api-class/.
 */

namespace TheJano\TextTranslator\Traits;

trait FluentApi
{
    public function __call($method, $args)
    {
        return $this->call($method, $args);
    }

    public static function __callStatic($method, $args)
    {
        return (new static())->call($method, $args);
    }

    private function call($method, $args)
    {
        if (! method_exists($this, '_' . $method)) {
            throw new \Exception('Call undefined method ' . $method);
        }

        return $this->{'_' . $method}(...$args);
    }
}

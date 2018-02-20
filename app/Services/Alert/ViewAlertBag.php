<?php

namespace App\Services\Alert;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class ViewAlertBag implements Jsonable, JsonSerializable
{
    /**
     * The array of the view alert bags.
     *
     * @var array
     */
    protected $bags = [];

    /**
     * Checks if a named MessageBag exists in the bags.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasBag($key = 'default')
    {
        return isset($this->bags[$key]);
    }

    /**
     * Get a MessageBag instance from the bags.
     *
     * @param  string  $key
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    public function getBag($key)
    {
        return Arr::get($this->bags, $key) ?: new AlertMessageBag;
    }

    /**
     * Create a new MessageBag instance in the bags.
     *
     * @param  string  $key
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    public function createBag($key)
    {
        return Arr::set($this->bags, $key, new AlertMessageBag());
    }

    /**
     * Get all the bags.
     *
     * @return array
     */
    public function getBags()
    {
        return $this->bags;
    }

    /**
     * Add a new MessageBag instance to the bags.
     *
     * @param  string  $key
     * @param  \App\Services\Alert\AlertMessageBag  $bag
     * @return $this
     */
    public function put($key, $bag)
    {
        $this->bags[$key] = $bag;

        return $this;
    }

    /**
     * Add a new message to the bags.
     *
     * @param  string  $key
     * @param  string  $severity
     * @param  string  $message
     * @return $this
     */
    public function add($key, $severity, $message)
    {
        if(!$this->hasBag($key)){
            $this->createBag($key);
        }

        $this->bags[$key]->add($severity, $message);

        return $this;
    }

    /**
     * Get the number of messages in the default bag.
     *
     * @return int
     */
    public function count()
    {
        return $this->getBag('default')->count();
    }

    /**
     * Dynamically call methods on the default bag.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->getBag('default')->$method(...$parameters);
    }

    /**
     * Dynamically access a view error bag.
     *
     * @param  string  $key
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    public function __get($key)
    {
        return $this->getBag($key);
    }

    /**
     * Dynamically set a view alert bag.
     *
     * @param  string  $key
     * @param  \Illuminate\Contracts\Support\MessageBag  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->put($key, $value);
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->getBags();
    }
}
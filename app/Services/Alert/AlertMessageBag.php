<?php

namespace App\Services\Alert;

use Countable;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class AlertMessageBag implements Arrayable, Countable, Jsonable, JsonSerializable
{
    /**
     * All of the registered messages.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Create a new message bag instance.
     *
     * @param  array $messages
     * @return void
     */
    public function __construct(array $messages = [])
    {
        $this->messages = $messages;
    }

    /**
     * Add a message to the bag.
     *
     * @param  \App\Services\Alert\AlertMessage $message
     * @return $this
     */
    public function add($message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Get the first message from the bag for a given key.
     *
     * @return string
     */
    public function first()
    {
        return array_first($this->messages());
    }

    /**
     * Get all of the messages for every key in the bag.
     *
     * @return array
     */
    public function all()
    {
        return $this->messages();
    }

    /**
     * Get the raw messages in the container.
     *
     * @return array
     */
    public function messages()
    {
        return $this->messages;
    }

    /**
     * Get the raw messages in the container.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages();
    }

    /**
     * Determine if the message bag has any messages.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return !$this->any();
    }

    /**
     * Determine if the message bag has any messages.
     *
     * @return bool
     */
    public function any()
    {
        return $this->count() > 0;
    }

    /**
     * Get the number of messages in the container.
     *
     * @return int
     */
    public function count()
    {
        return count($this->messages());
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getMessages();
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Convert the message bag to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
<?php

namespace App\Services\Alert;

use Countable;
use Illuminate\Support\Str;
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
     * @param  array  $messages
     * @return void
     */
    public function __construct(array $messages = [])
    {
        foreach ($messages as $key => $value) {
            $this->messages[$key] = is_array($value) ? $value : [$value];
        }
    }

    /**
     * Get the keys present in the message bag.
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->messages);
    }

    /**
     * Add a message to the bag.
     *
     * @param  string  $key
     * @param  \App\Services\Alert\AlertMessage  $message
     * @return $this
     */
    public function add($key, $message)
    {
        if ($this->isUnique($key, $message)) {
            $this->messages[$key][] = $message;
        }

        return $this;
    }

    /**
     * Merge a new array of messages into the bag.
     *
     * @param  \Illuminate\Contracts\Support\MessageProvider|array  $messages
     * @return $this
     */
    public function merge($messages)
    {
        if ($messages instanceof MessageProvider) {
            $messages = $messages->getMessageBag()->getMessages();
        }

        $this->messages = array_merge_recursive($this->messages, $messages);

        return $this;
    }

    /**
     * Determine if a key and message combination already exists.
     *
     * @param  string  $key
     * @param  string  $message
     * @return bool
     */
    protected function isUnique($key, $message)
    {
        $messages = (array) $this->messages;

        return ! isset($messages[$key]) || ! in_array($message, $messages[$key]);
    }

    /**
     * Determine if messages exist for all of the given keys.
     *
     * @param  array|string  $key
     * @return bool
     */
    public function has($key)
    {
        if (is_null($key)) {
            return $this->any();
        }

        $keys = is_array($key) ? $key : func_get_args();

        foreach ($keys as $key) {
            if ($this->first($key) === '') {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine if messages exist for any of the given keys.
     *
     * @param  array  $keys
     * @return bool
     */
    public function hasAny($keys = [])
    {
        foreach ($keys as $key) {
            if ($this->has($key)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the first message from the bag for a given key.
     *
     * @param  string  $key
     * @return string
     */
    public function first($key = null)
    {
        $messages = is_null($key) ? $this->all() : $this->get($key);

        return count($messages) > 0 ? $messages[0] : '';
    }

    /**
     * Get all of the messages from the bag for a given key.
     *
     * @param  string  $key
     * @return array
     */
    public function get($key)
    {
        // If the message exists in the container, we will transform it and return
        // the message. Otherwise, we'll check if the key is implicit & collect
        // all the messages that match a given key and output it as an array.
        if (array_key_exists($key, $this->messages)) {
            return $this->messages[$key];
        }

        if (Str::contains($key, '*')) {
            return $this->getMessagesForWildcardKey($key, $format);
        }

        return [];
    }

    /**
     * Get the messages for a wildcard key.
     *
     * @param  string  $key
     * @return array
     */
    protected function getMessagesForWildcardKey($key)
    {
        return collect($this->messages)
            ->filter(function ($messages, $messageKey) use ($key) {
                return Str::is($key, $messageKey);
            })->all();
    }

    /**
     * Get all of the messages for every key in the bag.
     *
     * @return array
     */
    public function all()
    {
        $all = [];

        foreach ($this->messages as $key => $messages) {
            $all = array_merge($all, $messages);
        }

        return $all;
    }

    /**
     * Get all of the unique messages for every key in the bag.
     *
     * @return array
     */
    public function unique()
    {
        return array_unique($this->all());
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
     * Get the messages for the instance.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getMessageBag()
    {
        return $this;
    }

    /**
     * Determine if the message bag has any messages.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return ! $this->any();
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
        return count($this->messages, COUNT_RECURSIVE) - count($this->messages);
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
     * @param  int  $options
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
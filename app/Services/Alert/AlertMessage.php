<?php

namespace App\Services\Alert;

use App\Services\Alert\Types\Severity;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class AlertMessage implements Jsonable, JsonSerializable
{
    /**
     * Message title
     *
     * @var string
     */
    private $title;

    /**
     * Message description
     *
     * @var string
     */
    private $description;

    /**
     * Message Severity
     *
     * @var string
     */
    private $severity;

    /**
     * Message Config
     *
     * @var array
     */
    private $config;

    /**
     * Message display type
     *
     * @var string
     */
    private $displayType = 'default';

    /**
     * Create a new Alert message instance.
     *
     * @param  string $description
     * @param  string $title
     * @param  string $severity
     * @param  string $displayType
     * @param  array $config
     * @return void
     */
    public function __construct($description, $title = '', $severity = 'info', $displayType = 'default', $config = [])
    {
        $this->description = $description;
        $this->title = $title;
        $this->severity = strtolower($severity);
        $this->displayType = $displayType;
        $this->config = $config;
    }

    /**
     * Get Message Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set Message Title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get Message Description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set Message Description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get Message Severity
     *
     * @return string
     */
    public function getSeverity()
    {
        return $this->severity;
    }

    /**
     * Set Message Severity
     *
     * @param string $severity
     * @return $this
     */
    public function setSeverity($severity)
    {
        $this->severity = $severity;

        return $this;
    }

    /**
     * Get Alert display type
     *
     * @return string
     */
    public function getDisplayType()
    {
        return $this->displayType;
    }

    /**
     * Set Alert display type
     *
     * @param string $displayType
     * @return string
     */
    public function setDisplayType($displayType)
    {
        $this->displayType = $displayType;

        return $this;
    }

    /**
     * Get Message Config
     *
     * @param  string $key Config name
     * @return array
     */
    public function getConfig($key = null)
    {
        if ($key) {
            return isset($this->config[$key]) ? $this->config[$key] : null;
        }

        return $this->config;
    }

    /**
     * Set Message Config
     *
     * @param array $config
     * @return $this
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Add new config for Message
     *
     * @param  string $key
     * @param  string $value
     * @return $this
     */
    public function addConfig($key, $value)
    {
        array_set($this->config, $key, $value);

        return $this;
    }

    /**
     * Remove message config
     *
     * @param  string $key
     * @return $this
     */
    public function removeConfig($key = null)
    {
        if (is_null($key)) {
            $this->setConfig([]);
        } else {
            array_forget($this->config, $key);
        }

        return $this;
    }

    /**
     * Set message as dismissible
     *
     * @param bool $isDismissible
     * @return $this
     */
    public function dismissible($isDismissible = true)
    {
        $this->addConfig('dismissible', $isDismissible);

        return $this;
    }

    /**
     * Dynamically set properties or config
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        } else {
            $this->addConfig($name, $value);
        }
    }

    /**
     * Dynamically Access to a property or config
     *
     * @param $name string
     * @return mixed
     */
    function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        return $this->getConfig($name);
    }

    /**
     * View message description or title
     *
     * @return string
     */
    function __toString()
    {
        return $this->getDescription() ?: $this->getTitle();
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'severity' => $this->getSeverity(),
            'displayType' => $this->displayType,
            'config' => $this->getConfig(),
        ];
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
}
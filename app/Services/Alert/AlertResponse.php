<?php

namespace App\Services\Alert;

use App\Services\Alert\Types\Severity;
use Illuminate\Session\Store as SessionStore;

class AlertResponse
{
    /**
     * The session store implementation.
     *
     * @var \Illuminate\Session\Store
     */
    protected $session;

    /**
     * Create a new Alert instance.
     *
     * @param  \Illuminate\Session\Store $session
     * @return void
     */
    public function __construct(SessionStore $session)
    {
        $this->setSession($session);
    }

    /**
     * Set the session store implementation.
     *
     * @param  \Illuminate\Session\Store $session
     * @return void
     */
    public function setSession(SessionStore $session)
    {
        $this->session = $session;
    }

    /**
     * Get the session store implementation.
     *
     * @return \Illuminate\Session\Store|null
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Get allowed alert severity levels
     *
     * @return string[]
     */
    protected function getSeverityLevels()
    {
        return Severity::keys();
    }

    /**
     * Parse message to get a AlertMessageBag instance
     *
     * @param AlertMessage|mixed $provider
     * @return AlertMessage
     */
    protected function parseAlert($provider)
    {
        if ($provider instanceof AlertMessage) {
            return $provider;
        }

        return new AlertMessage($provider);
    }

    /**
     * Add new message
     *
     * @param $message
     * @param $severity
     * @param $key
     * @return $this
     */
    public function add($message, $severity, $key)
    {
        $alert = $this->parseAlert($message);

        $alert->setSeverity(Severity::search($severity));

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, $alert)
        );

        return $this;
    }

    /**
     * Set a success alert
     *
     * @param  string $message
     * @param  string $key
     * @return $this
     */
    public function success($message, $key = 'default')
    {
        return $this->add($message, Severity::SUCCESS, $key);
    }

    /**
     * Set a debug alert
     *
     * @param  string $message
     * @param  string $key
     * @return $this
     */
    public function debug($message, $key = 'default')
    {
        return $this->add($message, Severity::DEBUG, $key);
    }

    /**
     * Set an info alert
     *
     * @param  string $message
     * @param  string $key
     * @return $this
     */
    public function info($message, $key = 'default')
    {
        return $this->add($message, Severity::INFO, $key);
    }

    /**
     * Set a notice alert
     *
     * @param  string $message
     * @param  string $key
     * @return $this
     */
    public function notice($message, $key = 'default')
    {
        return $this->add($message, Severity::NOTICE, $key);
    }

    /**
     * Set a warning alert
     *
     * @param  string $message
     * @param  string $key
     * @return $this
     */
    public function warning($message, $key = 'default')
    {
        return $this->add($message, Severity::WARNING, $key);
    }

    /**
     * Set an error alert
     *
     * @param  string $message
     * @param  string $key
     * @return $this
     */
    public function error($message, $key = 'default')
    {
        return $this->add($message, Severity::ERROR, $key);
    }

    /**
     * Set a critical alert
     *
     * @param  string $message
     * @param  string $key
     * @return $this
     */
    public function critical($message, $key = 'default')
    {
        return $this->add($message, Severity::CRITICAL, $key);
    }

    /**
     * Set an alert level alert
     *
     * @param  string $message
     * @param  string $key
     * @return $this
     */
    public function alert($message, $key = 'default')
    {
        return $this->add($message, Severity::ALERT, $key);
    }

    /**
     * Set an emergency alert
     *
     * @param  string $message
     * @param  string $key
     * @return $this
     */
    public function emergency($message, $key = 'default')
    {
        return $this->add($message, Severity::EMERGENCY, $key);
    }
}
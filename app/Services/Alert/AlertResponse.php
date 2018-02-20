<?php

namespace App\Services\Alert;

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
     * @param  \Illuminate\Session\Store  $session
     * @return void
     */
    public function __construct(SessionStore $session)
    {
        $this->setSession($session);
    }

    /**
     * Set the session store implementation.
     *
     * @param  \Illuminate\Session\Store  $session
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
        return ['success', 'debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'];
    }

    /**
     * Parse message to get a AlertMessageBag instance
     *
     * @param AlertMessage|mixed $provider
     * @return AlertMessage
     */
    protected function parseAlert($provider)
    {
        if($provider instanceof AlertMessage){
            return $provider;
        }

        return new AlertMessage($provider);
    }

    /**
     * Set a success alert
     *
     * @param  string  $message
     * @param  string  $key
     * @return $this
     */
    public function success($message, $key = 'default')
    {
        $alert = $this->parseAlert($message);
        $alert->setSeverity('success');

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, 'success', $alert)
        );

        return $this;
    }

    /**
     * Set a debug alert
     *
     * @param  string  $message
     * @param  string  $key
     * @return $this
     */
    public function debug($message, $key = 'default')
    {
        $alert = $this->parseAlert($message);
        $alert->setSeverity('debug');

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, 'debug', $alert)
        );

        return $this;
    }

    /**
     * Set an info alert
     *
     * @param  string  $message
     * @param  string  $key
     * @return $this
     */
    public function info($message, $key = 'default')
    {
        $alert = $this->parseAlert($message);
        $alert->setSeverity('info');

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, 'info', $alert)
        );

        return $this;
    }

    /**
     * Set a notice alert
     *
     * @param  string  $message
     * @param  string  $key
     * @return $this
     */
    public function notice($message, $key = 'default')
    {
        $alert = $this->parseAlert($message);
        $alert->setSeverity('notice');

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, 'notice', $alert)
        );

        return $this;
    }

    /**
     * Set a warning alert
     *
     * @param  string  $message
     * @param  string  $key
     * @return $this
     */
    public function warning($message, $key = 'default')
    {
        $alert = $this->parseAlert($message);
        $alert->setSeverity('warning');

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, 'warning', $alert)
        );

        return $this;
    }

    /**
     * Set an error alert
     *
     * @param  string  $message
     * @param  string  $key
     * @return $this
     */
    public function error($message, $key = 'default')
    {
        $alert = $this->parseAlert($message);
        $alert->setSeverity('error');

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, 'error', $alert)
        );

        return $this;
    }

    /**
     * Set a critical alert
     *
     * @param  string  $message
     * @param  string  $key
     * @return $this
     */
    public function critical($message, $key = 'default')
    {
        $alert = $this->parseAlert($message);
        $alert->setSeverity('critical');

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, 'critical', $alert)
        );

        return $this;
    }

    /**
     * Set an alert level alert
     *
     * @param  string  $message
     * @param  string  $key
     * @return $this
     */
    public function alert($message, $key = 'default')
    {
        $alert = $this->parseAlert($message);
        $alert->setSeverity('alert');

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, 'alert', $alert)
        );

        return $this;
    }

    /**
     * Set an emergency alert
     *
     * @param  string  $message
     * @param  string  $key
     * @return $this
     */
    public function emergency($message, $key = 'default')
    {
        $alert = $this->parseAlert($message);
        $alert->setSeverity('emergency');

        $this->getSession()->flash(
            'alerts', $this->getSession()->get('alerts', new ViewAlertBag())->add($key, 'emergency', $alert)
        );

        return $this;
    }

}
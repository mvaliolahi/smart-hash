<?php

namespace Mvaliolahi\SmartHash;

class Config
{
    protected $config = [];
    protected $key;

    public function setKey($key)
    {
        $this->model = $key;

        return $this;
    }

    public function disable()
    {
        $this->config[$this->key] = true;

        return $this;
    }

    public function enable()
    {
        $this->config[$this->key] = false;

        return $this;
    }

    public function isDisabled()
    {
        return ($this->config[$this->key] ?? false) == true;
    }

    public function isEnable()
    {
        return $this->config[$this->key] == false;
    }
}

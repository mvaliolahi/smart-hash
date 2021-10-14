<?php

namespace Mvaliolahi\SmartHash\Traits;

use Hashids\Hashids;
use Mvaliolahi\SmartHash\Config;

trait SmartHash
{
    public function disableHash()
    {
        $this->config()->disable();

        return $this;
    }

    public function id(): int
    {
        return $this->getRawOriginal('id');
    }

    public function getIdAttribute($value): string
    {
        if ($this->config()->isDisabled()) {
            $this->config()->enable();

            return $value;
        }

        return (new Hashids())->encode($value);
    }

    private function config(): Config
    {
        return app(Config::class)
            ->setKey(get_class($this));
    }
}

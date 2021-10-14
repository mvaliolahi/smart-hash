<?php

namespace Mvaliolahi\SmartHash\Traits;

use Hashids\Hashids;

trait SmartHash
{
    private static $enableHash = true;

    public function disableHash()
    {
        $this->enableHash = false;

        return $this;
    }

    public function id(): int
    {
        return $this->getRawOriginal('id');
    }

    public function getIdAttribute($value): string
    {
        if (!$this->enableHash) {
            $this->enableHash = true;

            return $value;
        }

        return (new Hashids())->encode($value);
    }
}

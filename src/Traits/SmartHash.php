<?php

namespace Mvaliolahi\SmartHash\Traits;

use Hashids\Hashids;

trait SmartHash
{
    public function id(): int
    {
        return $this->getRawOriginal('id');
    }

    public function getIdAttribute($value): string
    {
        return (new Hashids())->encode($value);
    }
}

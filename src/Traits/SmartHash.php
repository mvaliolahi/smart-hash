<?php

namespace Mvaliolahi\SmartHash\Traits;

use Hashids\Hashids;

trait SmartHash
{
    public function __construct(array $attributes = [])
    {
        $this->hidden[] = 'id';
        $this->appends[] = 'hash_id';
        parent::__construct($attributes);
    }

    public function id(): int
    {
        return $this->getRawOriginal('id');
    }

    public function hasId(): int
    {
        return (new Hashids())->encode($this->id);
    }

    function getHashIdAttribute()
    {
        return (new Hashids())->encode($this->id);
    }
}

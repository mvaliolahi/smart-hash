<?php

namespace Mvaliolahi\SmartHash\Traits;

use Hashids\Hashids;

trait SmartHash
{
    public function __construct()
    {
        parent::__construct();
        $this->hidden[] = 'id';
        $this->appends[] = 'hash_id';
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

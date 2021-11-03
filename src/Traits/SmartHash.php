<?php

namespace Mvaliolahi\SmartHash\Traits;

use Hashids\Hashids;

trait SmartHash
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->hidden[] = 'id';
        $this->appends[] = 'hash_id';
    }

    public function id(): int
    {
        return $this->getRawOriginal('id');
    }

    public function hasId(): int
    {
        return $this->encodeHash($this->id);
    }

    function getHashIdAttribute()
    {
        return $this->encodeHash($this->id);
    }

    public static function findByHash($hashId) 
    {
        return static::find(
            self::decodeHash($hashId)
        );
    }

    public static function findOrFailByHash($hashId) 
    {
        return static::findOrFail(
            self::decodeHash($hashId)
        );
    }

    private static function decodeHash($hash) 
    {
        return (new Hashids())->decode($hash)[0];
    }

    private function encodeHash($p) 
    {
        return (new Hashids())->encode($p);
    }
}

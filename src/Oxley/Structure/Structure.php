<?php
namespace Oxley\Structure;

abstract class Structure {
    private $key;
    
    protected $redis;
    
    public function __construct($key, $redis) {
        $this->key = $key;
        $this->redis = $redis;
    }
    
    public function key() {
        return $this->key;
    }
    
    public function exists() {
        return $this->redis->EXISTS($this->key());
    }
    
    public function expire($seconds) {
        return $this->redis->EXPIRE($this->key(), $seconds);
    }
    
    public function expireAt($timestampOrDate) {
        if (is_string($timestampOrDate)) {
            $timestampOrDate = strtotime($timestampOrDate);
        }
        
        return $this->redis->EXPIREAT($this->key(), $timestampOrDate);
    }
    
    public function persist() {
        return $this->redis->PERSIST($this->key());
    }
    
    public function rename($newKey) {
        return (bool)(
            $this->redis->RENAME($this->key(), $newKey) 
            && 
            $this->key = $newKey
        );
    }
    
    public function renameNX($newKey) {
        return (bool)(
            $this->redis->RENAMENX($this->key(), $newKey) 
            && 
            $this->key = $newKey
        );
    }
    
    public abstract function __toString();
}
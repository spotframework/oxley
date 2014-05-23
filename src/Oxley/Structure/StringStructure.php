<?php
namespace Oxley\Structure;

class StringStructure extends Structure {
    public function set($value) {
        return $this->redis->SET($this->key(), $value);
    }
    
    public function len() {
        return $this->redis->STRLEN($this->key());
    }
    
    public function range($start, $stop) {
        return $this->redis->GETRANGE($this->key(), $start, $stop);
    }
    
    public function append($suffix) {
        return $this->redis->APPEND($this->key(), $suffix);
    }
    
    public function decrement($decrement = null) {
        return $decrement === null
            ? $this->redis->DECR($this->key())
            : $this->redis->DECRBY($this->key(), $decrement);
    }
    
    public function increment($increment = null) {
        if ($increment === null) {
            return $this->redis->INCR($this->key());
        }
        
        if (is_float($increment)) {
            return $this->redis->INCRBYFLOAT($this->key(), $increment);
        }
        
        return $this->redis->INCRBY($this->key(), $increment);
    }
    
    public function __toString() {
        return $this->redis->GET($this->key());
    }
}
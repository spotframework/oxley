<?php
namespace Oxley;

abstract class Oxley {
    public abstract function get($key);
    
    public abstract function hash($key);
    
    public abstract function set($key);
    
    public abstract function zset($key);
    
    public abstract function channel($key);
    
    static public function create() {
        
    }
}
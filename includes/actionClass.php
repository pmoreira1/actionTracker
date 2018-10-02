<?php

class ActionTracker {
    protected $db;

    function __construct(Db $db) {
        $this->db = $db;
    }

    public function hello() {
        echo "I'm here";
    }
}
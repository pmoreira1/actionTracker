<?php

class ActionTracker
{
    protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function hello()
    {
        echo "I'm here";
    }

    public function dayStart($date = false)
    {
        $q = "SELECT * from dayActions where `action`= 1 ";
        if ($date) {
            $q .= " and `dateTime` like '$date%'";
        }
        $q = " ORDER BY `dateTime` desc limit 1 ";
        return $this->db->select($q)[0];
    }
}

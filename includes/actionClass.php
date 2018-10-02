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
        $q .= " ORDER BY `dateTime` desc limit 1 ";
        return $this->db->select($q)[0];
    }

    public function dayEnd($date)
    {
        $dayStart = $this->dayStart['timestamp'];
        $q = "SELECT * from dayActions where `action` = 2 and `dateTime` > '$dayStart' ORDER BY `dateTime` desc limit 1";
        return $this->db->select($q)[0];
    }

    public function lastActivity($activity)
    {
        $q = "SELECT * from dayActions where `action`= $activity ORDER BY `dateTime` desc limit 1 ";
        return $this->db->select($q)[0];
    }

    public function dayActivity($activity, $date = false)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }
        $dayStart = $this->dayStart($date);
        $dayEnd = $this->dayEnd($date);
        $q = "SELECT COUNT(*) as `total` FROM dayActions WHERE `action` = $activity and `timestamp` BETWEEN " . $this->db->quote($dayStart['dateTime']) . "  and " . $this->db->quote($dayEnd['dateTime']) . "";
        return $this->db->select($q)[0];
    }

}

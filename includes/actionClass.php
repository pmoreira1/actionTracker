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
        $dayEnd = $this->db->select($q)[0];
        if (count($dayEnd) == 0) {
            //no sleep data add 24 hours to dayStart
            $dayEnd['dateTime'] = date('Y-m-d H:i:s', strtotime($dayStart . " + 24 hours"));
        }
        return $dayEnd;
    }

    public function lastActivity($activity)
    {
        $q = "SELECT *, TIMESTAMPDIFF(SECOND, `dateTime`,NOW()) AS secondsSince from dayActions where `action`= $activity ORDER BY `dateTime` desc limit 1 ";
        return $this->db->select($q)[0];
    }

    public function dayActivity($activity, $date = false)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }
        $dayEnd = $this->dayEnd($date)['dateTime'];
        $dayStart = $this->dayStart($date)['dateTime'];
        $q = "SELECT COUNT(*) as `total` FROM dayActions WHERE `action` = $activity and `dateTime` BETWEEN " . $this->db->quote($dayStart) . "  and " . $this->db->quote($dayEnd) . "";
        return $this->db->select($q)[0];
    }

}

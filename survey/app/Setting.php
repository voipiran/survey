<?php

namespace App;

class Setting
{
    function getQueues($conn)
    {
        $sql = "SELECT survey_queue FROM `settings`";
        $query = $conn->query($sql);
        $queues = [];
        if ($query->num_rows > 0) {
            while ($q = $query->fetch_assoc()) {
                array_push($queues , $q['survey_queue']);
            }
        }
        return $queues;
    }
}

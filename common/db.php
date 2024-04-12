<?php 
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('SlackLog.db');
    }
}

$db = new MyDB();

function get_channel_name($db, $channelCode){
    $results = $db->query('SELECT channel_id,name,is_private FROM channels WHERE channel_id like "'.$channelCode.'"');
    while ($row = $results->fetchArray()) {
        return $row['name'];
    }
}

function get_channel_code($db, $channelName){
    $results = $db->query('SELECT channel_id,name,is_private FROM channels WHERE name like "'.$channelName.'"');
    while ($row = $results->fetchArray()) {
        return $row['channel_id'];
    }
}

function get_channel_msgs($db,$channelName,$orderby){
    $results = $db->query('SELECT timestamp,name,text,files,msgid,channel FROM message WHERE channel like "'.$channelName.'" ORDER BY timestamp '.$orderby.';');
    return $results;
}

function get_channel_list($db){
    $channelList = [];
    $results = $db->query('SELECT channel_id,name,is_private FROM channels ORDER BY name ASC;');
    while ($row = $results->fetchArray()) {
        $channelList[$row['channel_id']] = $row['name'];
    }
    return $channelList;
}

?>
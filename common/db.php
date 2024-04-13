<?php 
class MyDB extends SQLite3
{
    function __construct($dbFilePath)
    {
        $this->open($dbFilePath);
    }
}

$db = new MyDB($dbFilePath);

function get_channel_name($db, $channelCode){
    $query = 'SELECT channel_id,name,is_private FROM channels WHERE channel_id like "'.$channelCode.'"';
    $results = $db->query($query);
    while ($row = $results->fetchArray()) {
        return $row['name'];
    }
}

function get_channel_code($db, $channelName){
    $query = 'SELECT channel_id,name,is_private FROM channels WHERE name like "'.$channelName.'"';
    $results = $db->query($query);
    while ($row = $results->fetchArray()) {
        return $row['channel_id'];
    }
}

function get_channel_msgs($db,$channelName,$orderby){
    $query = 'SELECT timestamp,name,text,files,msgid,channel FROM message WHERE channel like "'.$channelName.'" ORDER BY timestamp '.$orderby.';';
    $results = $db->query($query);
    return $results;
}

function search_channel_msgs($db,$searchWord,$orderby){
    $query = 'SELECT timestamp,name,text,files,msgid,channel FROM message WHERE text like "%'.$searchWord.'%" ORDER BY channel,timestamp '.$orderby.';';
    $results = $db->query($query);
    return $results;
}

function get_channel_list($db){
    $channelList = [];
    $query = 'SELECT channel_id,name,is_private FROM channels ORDER BY name ASC;';
    $results = $db->query($query);
    while ($row = $results->fetchArray()) {
        $channelList[$row['channel_id']] = $row['name'];
    }
    return $channelList;
}

?>
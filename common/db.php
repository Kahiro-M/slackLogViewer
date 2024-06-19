<?php 
// SQLiteとMySQLでの接続切替
if(DB_MODE == 'SQLite'){
    class MyDB extends SQLite3
    {
        function __construct($dbFilePath)
        {
            $this->open($dbFilePath);
        }
    }
    $db = new MyDB($dbFilePath);
}else{
    // DB接続
    function connect_db($host=DB_HOST, $dbname=DB_NAME, $username=DB_USERNAME, $password=DB_PASSWORD){
        try {
            $db_tmp = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $db_tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db_tmp;
        } catch (PDOException $e) {
            die("エラー: " . $e->getMessage());
        }
    }
    $db = connect_db();
}

// SQLiteのfetchArray()とMySQLのfetch()のラッパー関数
function db_fetch($results){
    if(DB_MODE == 'SQLite'){
        return $results->fetchArray();
    }else{
        return $results->fetch();
    }
}

function get_channel_name($db, $channelCode){
    $query = 'SELECT channel_id,name,is_private FROM channels WHERE channel_id like "'.$channelCode.'"';
    $results = $db->query($query);
    while ($row = db_fetch($results)) {
        return $row['name'];
    }
}

function get_channel_code($db, $channelName){
    $query = 'SELECT channel_id,name,is_private FROM channels WHERE name like "'.$channelName.'"';
    $results = $db->query($query);
    while ($row = db_fetch($results)) {
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
    while ($row = db_fetch($results)) {
        $channelList[$row['channel_id']] = $row['name'];
    }
    return $channelList;
}

function get_user_id($db, $display_name){
    $query = 'SELECT user_id,display_name FROM users WHERE display_name like "'.$display_name.'"';
    $results = $db->query($query);
    while ($row = db_fetch($results)) {
        return $row['user_id'];
    }
}


?>
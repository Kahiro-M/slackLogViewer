<?php 
include('./config/env.php');
$htmlTitle = '検索';
$cssList = ['./css/msg_search.css'];
$searchWord = $_POST['msg'];
// if(!empty($_GET['ch'])){
//     $channelCode = $_GET['ch'];
// }else{
//     $channelCode = $defaultChannelCode;
// }
if(!empty($_GET['odr'])){
    if(in_array($_GET['odr'],['asc','desc'])){
        $orderby = $_GET['odr'];
    }else{
        $orderby = 'ASC';
    }
}else{
    $orderby = 'ASC';
}

include('./common/func.php');
include('./common/db.php');
include('./template/header.php');

$channelName = '検索結果';
$results = search_channel_msgs($db,$searchWord,$orderby);
$count = 0;
while ($row = $results->fetchArray()) {
    $count++;
}
?>

<?php include('./template/sidebar.php'); ?>

<div class="msg_view">
    <div class="ch_title">
        <?php print($channelName); ?> : <?php print($count); ?><span class="channel_code"> ()</span>
    </div>

    <div class="msg_body">
<?php 
$results->reset();
$prevMsgChannel = '';
while ($row = $results->fetchArray()) {
    if($prevMsgChannel == $row['channel']){
        $prevMsgChannel = $row['channel'];
    }else{
?>
<?php 
    }
?>
        <a class="serach_link" href="viewer_channel.php?ch=<?php print(get_channel_code($db, $row['channel']));?>#<?php print($row['msgid']);?>">

            <div class="msg">
                <div class="search_channel_title"># <?php print($row['channel']); ?></div>
                <img src="<?php if(!empty(get_user_id($db,$row['name']))){print('./img/user_icon/'.get_user_id($db,$row['name']).'.jpg');}else{print('/img/default_icon.png');} ?>" class="user_icon">
                <div class="msg_info">
                    <div class="msg_name"><?php print($row['name']);?></div>
                    <div class="msg_timestamp"><?php print($row['timestamp']);?></div>
                    <div class="msg_channel"><?php print($row['channel']);?></div>
                </div>
                <div class="msg_content">
<?php   if(!empty($row['files'])){ ?>
                    <span class="dummy_link">添付ファイル</span><br>
<?php   }?>
                    <?php print(nl2br(replace_http_to_link($row['text'])));?>
                </div>
            </div>
        </a>
<?php }?>
<div id="eom" class="msg"></div>
    </div> <!-- class="msg_body"> -->
</div> <!-- class="msg_view"> -->

<?php 
include('./template/footer.php');
?>
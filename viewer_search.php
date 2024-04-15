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
?>

<?php include('./template/sidebar.php'); ?>

<div class="msg_body">
    <div class="ch_title">
        <?php print($channelName); ?><span class="channel_code"> ()</span>
    </div>
<?php 
$results = search_channel_msgs($db,$searchWord,$orderby);
while ($row = $results->fetchArray()) {
?>
    <div class="msg">
        <img src="./img/default_icon.png" class="user_icon">
        <div class="msg_info">
            <div class="msg_name"><?php print($row['name']);?></div>
            <div class="msg_timestamp"><?php print($row['timestamp']);?></div>
            <div class="msg_channel"><?php print($row['channel']);?></div>
        </div>
        <div class="msg_content">
<?php   if(!empty($row['files'])){ ?>
            <a href="<?php print($row['files']);?>">添付ファイル</a><br>
<?php   }?>
        <?php print(nl2br(replace_http_to_link($row['text'])));?>
    </div>
    </div>
<?php }?>
<div id="eom" class="msg"></div>
</div> <!-- class="msg_body"> -->

<?php 
include('./template/footer.php');
?>
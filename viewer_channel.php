<?php 
include('./config/env.php');
$htmlTitle = 'チャンネル';
$channelName = '00_全メンバー';
$cssPath = './css/msg.css';
if(!empty($_GET['ch'])){
    $channelCode = $_GET['ch'];
}else{
    $channelCode = $defaultChannelCode;
}
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

$channelName = get_channel_name($db, $channelCode);
?>

<div class="ch_list">
<?php 
$channels = get_channel_list($db);
foreach($channels as $chCode => $chName){
?>
    <div>
        <a href="viewer_channel.php?ch=<?php print($chCode); ?>#eom"><?php print($chName); ?></a>
    </div>
<?php 
}
?>
</div>


<div class="msg_body">
    <div class="ch_title">
        <?php print($channelName); ?><span class="channel_code"> (<?php print($channelCode); ?>)</span>
<?php if(empty($channelCode)){ ?>
    ←からチャンネルを選択してください。
<?php } ?>
    </div>
<?php 
$results = get_channel_msgs($db,$channelName,$orderby);
while ($row = $results->fetchArray()) {
?>
    <div class="msg">
        <div class="msg_info">
            <div class="msg_channel"><?php print($row['channel']);?></div>
            <div class="msg_name"><?php print($row['name']);?></div>
            <div class="msg_timestamp"><?php print($row['timestamp']);?></div>
        </div>
        <div class="msg_content">
<?php   if(!empty($row['files'])){ ?>
            <a href="<?php print($row['files']);?>">添付ファイル</a><br>
<?php   }?>
        <?php print($row['text']);?>
    </div>
    </div>
<?php }?>
<div id="eom" class="msg"></div>
</div> <!-- class="msg_body"> -->

<?php 
include('./template/footer.php');
?>
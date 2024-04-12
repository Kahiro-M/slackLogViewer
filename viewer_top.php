<?php 
$htmlTitle = 'TOP';
$cssPath = './css/msg.css';
if(!empty($_GET['ch'])){
    $channelCode = $_GET['ch'];
}else{
    $channelCode = get_channel_name($db, $channelName);
}

include('./template/header.php');
include('./common/func.php');
include('./common/db.php');

$channelName = get_channel_name($db, $channelCode);
?>

<div><?php print($channelName); ?> (<?php print($channelCode); ?>)</div>

<?php 
$results = $db->query('SELECT timestamp,name,text,files,msgid,channel FROM message WHERE channel like "'.$channelName.'"');
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



<?php 
include('./template/footer.php');
?>
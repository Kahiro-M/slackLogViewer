<?php 
include('./config/env.php');
$htmlTitle = 'チャンネル';
$cssList = [];
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

<?php include('./template/sidebar.php'); ?>

<div class="msg_view">
    <div class="ch_title">
        <?php print($channelName); ?><span class="channel_code"> (<?php print($channelCode); ?>)</span>
    <?php if(empty($channelCode)){ ?>
    ←からチャンネルを選択してください。
    <?php } ?>
    </div>
    <div class="msg_body">
<?php 
$results = get_channel_msgs($db,$channelName,$orderby);
while ($row = $results->fetchArray()) {
?>
        <div class="msg" id="<?php print($row['msgid']);?>">
            <img src="<?php if(!empty(get_user_id($db,$row['name']))){print('./img/user_icon/'.get_user_id($db,$row['name']).'.jpg');}else{print('/img/default_icon.png');} ?>" class="user_icon">
            <div class="msg_info">
                <div class="msg_name"><?php print($row['name']);?></div>
                <div class="msg_timestamp"><?php print($row['timestamp']);?></div>
                <div class="msg_channel"><?php print($row['channel']);?></div>
            </div>
            <div class="msg_content">

<?php 
    // ファイル保管場所から該当ファイルを検索
    $attachFileList = glob($filesDirPath.'/'.$row['msgid'].'*');

    // 添付ファイル表示
    if(!empty($row['files'])){
        if(count($attachFileList)>0){
            foreach($attachFileList as $attachFile){
                // 添付ファイルフォルダ内にmsgidを含むファイルがあれば表示
                $fileType = pathinfo($attachFile,PATHINFO_EXTENSION);
?>
                <a target="_blank" href="<?php print($attachFile);?>"><?php if(in_array($fileType,['apng','avif','gif','jpg','jpeg','jfif','pjpeg','pjp','png','svg','webp'])){print('<img src="'.$attachFile.'" class="attachImg">');}else{print('添付ファイル');}  ?></a>
<?php       } ?>
                <br>
<?php   }else{ ?>
                <a target="_blank" href="<?php print($row['files']);?>">添付ファイル</a><br>
<?php
        }
    }
?>
                <?php print(nl2br(replace_http_to_link($row['text'])));?>
            </div>
        </div>
<?php }?>
<div id="eom" class="msg"></div>
    </div> <!-- class="msg_body"> -->
</div> <!-- class="msg_view"> -->

<?php 
include('./template/footer.php');
?>
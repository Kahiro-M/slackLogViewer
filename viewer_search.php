<?php 
include('./config/env.php');
$htmlTitle = '検索';
$cssList = ['./css/msg_search.css'];
$searchWord = $_POST['msg'];
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
$count = db_count($results);
?>

<?php include('./template/sidebar.php'); ?>

<div class="msg_view">
    <div class="ch_title">
        <?php print($channelName); ?> : <?php print($count); ?><span class="channel_code"> ()</span>
    </div>

    <div class="msg_body">
<?php 
$prevMsgChannel = '';
while ($row = db_fetch($results)) {
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
                    <span class="dummy_link"><?php if(in_array($fileType,['apng','avif','gif','jpg','jpeg','jfif','pjpeg','pjp','png','svg','webp'])){print('<img src="'.$attachFile.'" class="attachImg">');}else{print(str_replace($row['msgid'].'_','',pathinfo($attachFile,PATHINFO_BASENAME)));}  ?></span>
<?php       } ?>
                    <br>
<?php   }else{ ?>
                    <span class="dummy_link">添付ファイル</span>
<?php
        }
    }
?>
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
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
        <?php print($channelName); ?> Canvas<span class="channel_code"> (<?php print($channelCode); ?>)</span>
    <?php if(empty($channelCode)){ ?>
    ←からチャンネルを選択してください。
    <?php } ?>
    </div>
    <div class="canvas_body">

<?php 
    $canvasFilePath = glob($filesDirPath.'/'.$channelCode.'*.html')[0];
    include($canvasFilePath);
?>
    </div> <!-- class="canvas_body"> -->
</div> <!-- class="msg_view"> -->

<?php 
include('./template/footer.php');
?>
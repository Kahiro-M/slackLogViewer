
<div class="ch_list">
    <div class="search_bar">
        <form action="viewer_search.php" method="post">
            <input type="text" class="search_word" name="msg" value="<?php if(!empty($searchWord)){print($searchWord);} ?>">
            <button type="submit" name="searching"><img src="./../img/manage_search.svg"></button>
        </form>
    </div>

<?php 
$channels = get_channel_list($db);
foreach($channels as $chCode => $chName){
    $canvas = glob($filesDirPath.'/'.$chCode.'*.html');
?>
    <div class="channel_name <?php if($chCode == $channelCode){print('channel_selected');} ?>">
        <a href="viewer_channel.php?ch=<?php print($chCode); ?>#eom"><?php print($chName); ?></a>
<?php if(count($canvas) > 0){ ?>
        <div class="channel_canvas">
            <a href="viewer_canvas.php?ch=<?php print($chCode); ?>">canvas</a>
        </div>
<?php } ?>
    </div>
<?php 
}
?>
</div>


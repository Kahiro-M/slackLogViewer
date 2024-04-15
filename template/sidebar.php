
<div class="ch_list">
    <div class="search_bar">
        <form action="viewer_search.php" method="post">
            <input type="text" class="search_word" name="msg" value="<?php if(!empty($searchWord)){print($searchWord);} ?>">
            <input type="submit" name="searching" value="検索">
        </form>
    </div>

<?php 
$channels = get_channel_list($db);
foreach($channels as $chCode => $chName){
?>
    <div class="channel_name <?php if($chCode == $channelCode){print('channel_selected');} ?>">
        <a href="viewer_channel.php?ch=<?php print($chCode); ?>#eom"><?php print($chName); ?></a>
    </div>
<?php 
}
?>
</div>


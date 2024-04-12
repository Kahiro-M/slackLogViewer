<?php 
$htmlTitle = 'TOP';
$cssPath = './css/msg_all.css';

include('./template/header.php');
include('./common/func.php');
include('./common/db.php');
?>

<div>全メッセージ</div>


<?php $results = $db->query('SELECT timestamp,name,text,files,msgid,channel FROM message'); ?>
<table>
    <thead>
        <tr>
            <th scope="col">チャンネル</th>
            <th scope="col">名前</th>
            <th scope="col">日時</th>
            <th scope="col">添付</th>
            <th scope="col">メッセージ</th>
        </tr>
    </thead>
    <tbody>

<?php while ($row = $results->fetchArray()) { ?>
        <tr>
            <td scope="row" class="msg_channel"><?php print($row['channel']);?></td>
            <td scope="row" class="msg_name"><?php print($row['name']);?></td>
            <td scope="row" class="msg_timestamp"><?php print($row['timestamp']);?></td>
            <td scope="row" class="msg_files">
<?php if(!empty($row['files'])){ ?>
                <a href="<?php print($row['files']);?>">添付ファイル</a>
<?php }?>
            </td>
            <td scope="row" class="msg_text"><?php print($row['text']);?></td>
        </tr>
<!-- <div class="msg"> -->
    <!-- <div class="msg_info"> -->
        <!-- <?php print($row['channel']);?> -->
        <!-- <?php print($row['name']);?> -->
        <!-- <?php print($row['timestamp']);?> -->
    <!-- </div> -->
    <!-- <div class="msg_content"> -->
        <!-- <?php print($row['text']);?> -->
        <!-- <?php print($row['files']);?> -->
    <!-- </div> -->
<!-- </div> -->

<?php } ?>
    </tbody>
</table>


<?php 
include('./template/footer.php');
?>


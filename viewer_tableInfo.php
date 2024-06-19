<?php 
include('./config/env.php');
$htmlTitle = 'TOP';
$cssList = [];
include('./template/header.php');
include('./common/func.php');
include('./common/db.php');
?>

<div style="display:block;">
<div>チャンネル情報</div>

<div style="display:block;">

<?php 
$results = $db->query('SELECT * FROM channels');
while ($row = db_fetch($results)) {
    echo('<pre>');
    dbg_dump($row);
    echo('</pre>');
}
?>
</div>

<?php 
include('./template/footer.php');
?>


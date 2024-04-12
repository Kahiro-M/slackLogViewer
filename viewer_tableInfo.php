<?php 
$htmlTitle = 'TOP';
// $cssPath = './css/msg_all.css';

include('./template/header.php');
include('./common/func.php');
include('./common/db.php');
?>

<div>チャンネル情報</div>


<?php 
$results = $db->query('SELECT * FROM channels');
while ($row = $results->fetchArray()) {
    echo('<pre>');
    dbg_dump($row);
    echo('</pre>');
}


include('./template/footer.php');
?>


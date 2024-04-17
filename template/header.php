<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SlackLogViewer | <?= htmlspecialchars($htmlTitle) ?></title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
<?php foreach($cssList as $cssPath){ ?>
    <link rel="stylesheet" type="text/css" href="<?php if(!empty($cssPath)){print(htmlspecialchars($cssPath));} ?>">
<?php } ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/emojione@4.5.0/lib/js/emojione.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emojione@4.5.0/extras/css/emojione.min.css">
</head>
<body>
<div class="contents">

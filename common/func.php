<?php

function dbg_dump($val){
    echo('<pre>');
    var_dump($val);
    echo('</pre>');
}

function replace_http_to_link($text){
    $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
    $replace = '<a href="$1" target="_blank">$1</a>';
    $text    = preg_replace( $pattern, $replace, $text );
    return $text;
}

?>
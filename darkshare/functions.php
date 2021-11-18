<?php

//Credits: http://jeffreysambells.com/2012/10/25/human-readable-filesize-php
function human_filesize($bytes, $decimals = 2) {
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function file_is_image($mime_type)
{
    return in_array($mime_type, IMG_EXTENSIONS);
}

function file_is_text($mime_type)
{
    return in_array($mime_type, TXT_EXTENSIONS);
}
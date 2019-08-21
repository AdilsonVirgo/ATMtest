<?php

$target = '../storage/app/public_html/';
$shortcut = 'storage';

if (symlink($target, $shortcut)) {
    echo 'Done';
}

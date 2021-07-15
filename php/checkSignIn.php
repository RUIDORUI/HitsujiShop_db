<?php
session_start();

if (isset($_SESSION['signed'])) {
    $signed = $_SESSION['signed'];
    $level = $_SESSION['level'];
    if ($level == 'administrator') {
        echo 'administrator';

    } else if ($level == 'member') {
        echo 'member';
    }
} else {
    echo 'never signed';
}
<?php
session_start();

if (isset($_SESSION['signed'])) {
    $signed = $_SESSION['signed'];
    if ($signed == 'true') {
        echo 'true';

    } else {
        echo 'false';
    }
} else {
    echo 'never signed';
}
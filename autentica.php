<?php

//autentica.php
session_start();

//estas são as sessoes principais do meu site.
if (!isset($_SESSION['nome']) && !isset($_SESSION['email'])) {
    $msg = md5('expirou');
    header('location:index.php?msg=' . $msg);
} 

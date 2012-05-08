<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'config.php';

/*
 * Your logic here
 */

// adding message
FlashMessenger::addMessage('Comment successfully approved!');

// redirect
header('Location: example-result.php');

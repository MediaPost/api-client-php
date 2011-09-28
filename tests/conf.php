<?php

require_once '../client/MapiClient.php';

$ConsumerKey	= "";
$ConsumerSecret = "";
$Token		= "";
$TokenSecret	= "";

$mapi = new MapiClient($ConsumerKey, $ConsumerSecret, $Token, $TokenSecret);

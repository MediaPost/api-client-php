<?php
require '../vendor/autoload.php';

$mapi = new Mapi\Client(
    '', /* $ConsumerKey */
    '', /* $ConsumerSecret */
    '', /* $Token */
    ''  /* $TokenSecret */
);

return $mapi;

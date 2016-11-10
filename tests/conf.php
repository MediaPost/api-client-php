<?php

require '../vendor/autoload.php';

$mapi = new Mapi\Client(
    'b9203c0bbeef1ec7736c52f6c1189c72051f1ae67', /* $ConsumerKey */
    'b598cd9864489773745a25440da306ec', /* $ConsumerSecret */
    'd38451b2378c09c778e22737ff4f9f95051f1ae89', /* $Token */
    '3a3a70e4a87c6e3225bc0b6bf7a5ee5a'  /* $TokenSecret */
);

$mapi->setUrlBase('https://api-dev.mediapost.com.br');

return $mapi;

<?php
/**
 * Busca as informações de abertura de uma mensagem
 *
 * @copyright  2011 - MT4 Tecnologia
 * @author     Diego Matos <diego@mt4.com.br>
 * @author     Vinícius Campitelli <vsilva@mt4.com.br>
 * @category   MT4
 * @package    Mapi
 * @subpackage Tests
 * @since      2011-06-01
 */


try {
    $mapi = require 'conf.php';
    /*
     * Código da mensagem no @MediaPost
     */
    $cod = 352;
    $paginacao = [0, 9];
    $params = [
        'data_inicio' => '2018-09-27T00:00:00',
        'data_fim' => '2018-09-27T23:59:59',
    ];
    
    $arrResult = $mapi->get("resultado/abertura/cod/{$cod}", $params, [
        Mapi\Request\Config::RANGE => $paginacao
    ]);
    var_dump($arrResult);
} catch (Exception $e) {
    var_dump($e);
}

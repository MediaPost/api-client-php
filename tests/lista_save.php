<?php
/**
 * Cria uma lista
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
    
    $arrLista = [
        /*
        * Nome da lista
        */
        'nome' => 'Minha lista de contatos'
    ];
    
    $arrResult = $mapi->post('lista/salvar', $arrLista);
    var_dump($arrResult);
} catch (Exception $e) {
    var_dump($e);
}

<?php
/**
 * Salva um contato no @MediaPost
 *
 * @copyright  2011 - MT4 Tecnologia
 * @author     Diego Matos <diego@mt4.com.br>
 * @author     Vinícius Campitelli <vsilva@mt4.com.br>
 * @category   MT4
 * @package    Mapi
 * @subpackage Tests
 * @since      2011-06-01
 */

/*
 * É recomendado que essa operação seja feita em lotes de no máximo 500 contatos por vez
 */
$arrContato = [
    /*
     * Código da lista onde vai ficar o contato
     */
    'lista' => 1,
    'contato' => [
        [
            /*
             * Código do contato no sistema do cliente
             */
            'uidcli' => 1,
            
            /*
             * Dados adicionais do contato. usar o método /contato/campos para listar todos os campos disponíveis
             */
            'email' => 'email@exemplo.com',
            'livre1' => 'campo livre 1 é é',
            'livre2' => 'campo livre 2 ó ó ção'
        ]
    ]
];

try {
    $mapi = require 'conf.php';
    
    $arrResult = $mapi->put("contato/salvar", $arrContato);
    var_dump($arrResult);
} catch (Exception $e) {
    var_dump($e);
}

<?php
/**
 * Teste de criação de uma mensagem
 *
 * @copyright  2011 - MT4 Tecnologia
 * @author     Diego Matos <diego@mt4.com.br>
 * @author     Vinícius Campitelli <vsilva@mt4.com.br>
 * @category   MT4
 * @package    Mapi
 * @subpackage Tests
 * @since      2011-06-01
 */

$arrMensagem = [
    /*
     * Código da mensagem no sistema do cliente. Esse código será retornado junto com o código da mensagem
     * para facilitar a identificação da mensagem no sistema do cliente
     */
    'uidcli' => 897,
    
    /*
     * Código da mensagem no @MediaPost. Utilizado para alterar a mensagem ao invés de criar uma nova
     */
    'cod' => 0,
    
    /*
     * Remetente da mensagem.
     */
    'remetente' => [
        'nome' => 'Meu remetente',
        'email' => 'marketing@meusite.com.br'
    ],
    
    /*
     * Pasta onde deve ficar a mensagem
     */
    'pasta' => 'Pasta padrão',

    /*
     * Informações da mensagem.
     */
    'mensagem' => [
        'ganalytics' => 'CampanhaAPI',
        'assunto'    => 'TESTE API Acentos ç á é ê ' . time(),
        'html'       => 'Corpo da mensagem',
        'texto'      => 'Mensagem em TXT'
    ]
];

try {
    $mapi = require 'conf.php';
    
    $arrResult = $mapi->put('mensagem/salvar', $arrMensagem);
    var_dump($arrResult);
} catch (Exception $e) {
    var_dump($e);
}

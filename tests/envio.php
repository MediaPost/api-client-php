<?php
/**
 * Agenda o envio de uma mensagem
 *
 * @copyright  2011 - MT4 Tecnologia
 * @author     Diego Matos <diego@mt4.com.br>
 * @author     Vinícius Campitelli <vsilva@mt4.com.br>
 * @category   MT4
 * @package    Mapi
 * @subpackage Tests
 * @since      2011-06-01
 */

$arrEnvio = [
    /*
     * Data hora do envio. Formato SQL
     * Caso não seja informado o sistema assumirá a data atual como data do envio 
     */
    'datahora_envio' => '2018-01-01 10:00:00',
    
    /*
     * Códigos das listas que devem ser enviadas. Obrigatório.
     */
    'lista' => [
        749
    ],

    /*
     * Filtros da lista. Devem ser usados os campos do cadastro do contato.
     * Essa informação pode ser encontrada em URL_API/contato/campos
     */
    'filtro' => [
        'livre1' => [
            'valor1',
            'valor2',
            'valor3'
        ],
        'livre2' => [
            'valor1',
            'valor2'
        ],
        'livre3' => 'valor1'
    ]
];

try {
    $mapi = require 'conf.php';
    
    /*
     * Código da mensagem que será enviada
     */
    $cod = 398;
    
    $arrResult = $mapi->put("envio/cod/{$cod}", $arrEnvio);
    var_dump($arrResult);
} catch (Exception $e) {
    var_dump($e);
}

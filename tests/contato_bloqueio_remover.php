<?php
/**
 * Busca as informações de envios bloqueados de uma mensagem
 *
 * @copyright  2016 - MT4 Tecnologia
 * @author     Vinícius Campitelli <vsilva@mt4.com.br>
 * @category   MT4
 * @package    Mapi
 * @subpackage Tests
 * @since      2016-11-01
 */

try {
    $mapi = require 'conf.php';
    
    // A função retorna um objeto do tipo Mapi\Response...
    $result = $mapi->put('contato/bloqueio/remover', [
        'email' => [
            'email1@exemplo.com',
            'email2@exemplo.com',
            'email3@exemplo.com',
            'email4@exemplo.com',
            'email5@exemplo.com'
        ]
    ]);
    var_dump($result);
    
    // Mapi\Response pode ser tratado como um array (foreach, $result['indice'], etc...),
    // ou você pode retornar realmente um array com o método toArray()
    // var_dump($result->toArray());
} catch (Exception $e) {
    var_dump($e);
}

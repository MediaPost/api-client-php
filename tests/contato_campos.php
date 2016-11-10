<?php
/**
 * Busca os campos disponíveis para um contato
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
    
    $arrResult = $mapi->get('contato/campos');
    var_dump($arrResult);
} catch (Exception $e) {
    var_dump($e);
}

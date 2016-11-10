<?php
/**
 * Retorna o limite permitido para envio
 *
 * @copyright  2011 - MT4 Tecnologia
 * @author     Diego Matos <diego@mt4.com.br>
 * @author     Vinícius Campitelli <vsilva@mt4.com.br>
 * @category   MT4
 * @package    Mapi
 * @subpackage Tests
 * @since      2011-06-01
 */

$mapi = require 'conf.php';

try {
    $arrResult = $mapi->get('envio/limite', $arrEnvio);
    var_dump($arrResult);
} catch (Exception $e) {
    var_dump($e);
}

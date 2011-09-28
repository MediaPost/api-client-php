<?php
/**
 * Agenda o envio de uma mensagem
 *
 * @copyright 2011 - MT4 Tecnologia
 * @author Diego Matos <diego@mt4.com.br>
 * @category MT4
 * @package 
 * @subpackage 
 * @since 01/06/2011
 */

require_once 'conf.php';

/*
 * Data hora do envio. Formato SQL
 * Caso não seja informado o sistema assumirá a data atual como data do envio 
 */
$arrEnvio['datahora_envio'] = "2011-01-01 10:00:00";
/*
 * Códigos das listas que devem ser enviadas. Obrigatório.
 */
$arrEnvio['lista'][] = 749;

/*
 * Filtros da lista. Devem ser usados os campos do cadastro do contato.
 * Essa informação pode ser encontrada em URL_API/contato/campos
 */
$arrEnvio['filtro']['livre1'][] = "valor1";
$arrEnvio['filtro']['livre1'][] = "valor2";
$arrEnvio['filtro']['livre1'][] = "valor3";


$arrEnvio['filtro']['livre2'][] = "valor1";
$arrEnvio['filtro']['livre2'][] = "valor2";


$arrEnvio['filtro']['livre3'] = "valor1";
/*
 * Código da mensagem que será enviada
 */
$cod_mensagem = 398;

try { 
	$arrResult = $mapi->put("envio/cod/".$cod_mensagem, $arrEnvio);
	echo "<pre>".print_r($arrResult, true)."</pre>";die;
} catch (MapiException $e){
	throw $e; 
}
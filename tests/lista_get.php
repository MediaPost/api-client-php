<?php
/**
 * Busca uma lista pelo código
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
 * Código da lista
 */
$cod_lista = 1;

try { 
	$arrResult = $mapi->get("lista/cod/".$cod_lista);
	echo "<pre>".print_r($arrResult, true)."</pre>";die;
} catch (MapiException $e){
	throw $e; 
}
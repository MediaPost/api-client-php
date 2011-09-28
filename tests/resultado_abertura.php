<?php
/**
 * Busca as informações de abertura de uma mensagem
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
 * Código da mensagem no @MediaPost
 */
$cod_mensagem = 352;

try { 
	$arrResult = $mapi->get("resultado/abertura/cod/".$cod_mensagem);
	echo "<pre>".print_r($arrResult, true)."</pre>";die;
} catch (MapiException $e){
	throw $e; 
}
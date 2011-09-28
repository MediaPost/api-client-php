<?php
/**
 * Busca um contato pelo e-mail
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
 * Código do contato
 */
$email_contato = "teste@teste.com";

try { 
	$arrResult = $mapi->get("contato/email/".$email_contato);
	echo "<pre>".print_r($arrResult, true)."</pre>";die;
} catch (MapiException $e){
	throw $e; 
}
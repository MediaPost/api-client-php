<?php
/**
 * Salva um contato no @MediaPost
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
 * É recomentado que essa operação seja feita em lotes de no máximo 500 contatos por vez
 */

$arrContato = array();

/*
 * Código da lista onde vai ficar o contato
 */
$arrContato['lista'] = 506;

/*
 * Código do contato no sistema do cliente
 */
$arrContato['contato'][0]['uidcli'] = 1;
/*
 * Código do contato no @MediaPost. Usado para atualizar as informações do contato
 */
$arrContato['contato'][0]['cod'] = 0;
/*
 * Dados adicionais do contato. usar o método /contato/campos para listar todos os campos disponíveis
 */
$arrContato['contato'][0]['email'] = "teste".time();
$arrContato['contato'][0]['livre1'] = "campo livre 1 é é";
$arrContato['contato'][0]['livre2'] = "campo livre 2 ó ó ção";

try { 
	$arrResult = $mapi->put("contato/salvar", $arrContato);
	echo "<pre>".print_r($arrResult, true)."</pre>";die;
} catch (MapiException $e){
	throw $e; 
}
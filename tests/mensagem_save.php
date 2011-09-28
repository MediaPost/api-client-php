<?php
/**
 * Teste de criação de uma mensagem
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
 * Código da mensagem no sistema do cliente. Esse código será retornado junto com o código da mensagem
 * para facilitar a identificação da mensagem no sistema do cliente
 */
$arrMensagem['uidcli'] = 897;
/*
 * Código da mensagem no @MediaPost. Utilizado para alterar a mensagem ao invés de criar uma nova
 */
$arrMensagem['cod'] = 0;
/*
 * Remetente da mensagem.
 */
$arrMensagem['remetente']['nome'] 	= "Diego Matos";
$arrMensagem['remetente']['email'] 	= "diego@gmail.com";
/*
 * Pasta onde deve ficar a mensagem
 */
$arrMensagem['pasta'] = "Pasta padrão";

/*
 * Informações da mensagem.
 */
$arrMensagem['mensagem']['ganalytics'] = "CampanhaAPI";
$arrMensagem['mensagem']['assunto'] = "TESTE API Acentos ç á é ê ".time();
$arrMensagem['mensagem']['html'] = 'Atualize o seu cadastro, SãoPaulo, julho - 2011 - A agência de marketing esportivo, Wolff Sports & Marketing, acaba de completar cinco anos no mercado e traz na bagagem cerca de 300 patrocínios intermediados em eventos esportivos. Em 2010, a agência teve um aumento de 40% no faturamento e se destacou por ser uma das poucas agências no parque atua com marketing esportivo diretamente com clubes e federações regionais.<a href="http://www.mpost.com.br/">clique aqui.';
$arrMensagem['mensagem']['texto'] 	= "Mensagem em TXT";

try { 
	$arrResult = $mapi->put("mensagem/salvar", $arrMensagem);
	echo "<pre>".print_r($arrResult, true)."</pre>";die;
} catch (MapiException $e){
	throw $e; 
}
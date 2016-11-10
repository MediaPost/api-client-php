<?
require_once 'MapiException.php';
if (!function_exists('curl_init')) {
  throw new Exception('MapiClient needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('MapiClient needs the JSON PHP extension.');
}

require_once 'oauth/OAuth.php';

/**
 * Classe cliente de acesso da API do MediaPost
 *
 * @copyright 2011 - MT4 Tecnologia
 * @author Diego Matos <diego@mt4.com.br>
 * @category MT4
 * @package MAPI
 * @since 16/03/2011
 */
class MapiClient {
	const API_URL_BASE = "https://api.mediapost.com.br";
	private $_consumerKey = null;	
	private $_consumerSecret = null;
	private $_token = null;
	private $_tokenSecret = null;
	private $_custom_urlbase = null;
	
	/**
	 *	Método construtor
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	public function __construct($_consumerKey = false, $_consumerSecret = false, $_token = false, $_tokenSecret = false){
	 	if($_consumerKey){
	 		$this->setConsumerKey($_consumerKey);
	 	}
	 	
		if($_consumerSecret){
	 		$this->setConsumerSecret($_consumerSecret);
	 	}
	 	
		if($_token){
	 		$this->setToken($_token);
	 	}
	 	
		if($_tokenSecret){
	 		$this->setTokenSecret($_tokenSecret);
	 	}
	}
	/**
	 *	Método que altera a URL Base da API
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 17/03/2011
	 *	@return 
	 */
	public function setUrlBase($url){
	 	$this->_custom_urlbase = $url;
	}
	/**
	 *	Método que retorna a URL Base da API
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 17/03/2011
	 *	@return 
	 */
	public function getUrlBase(){
		if($this->_custom_urlbase){
			return $this->_custom_urlbase;
		} else {
			return self::API_URL_BASE;
		}
	}
	/**
	 *	Método que define um ConsumerKey
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	public function setConsumerKey($_consumerKey){
	 	$this->_consumerKey = $_consumerKey;
	}
	/**
	 *	Método que define um ConsumerSecret
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	public function setConsumerSecret($_consumerSecret){
	 	$this->_consumerSecret = $_consumerSecret;
	}
	/**
	 *	Método que define um Token
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	public function setToken($_token){
	 	$this->_token = $_token;
	}
	/**
	 *	Método que define um TokenSecret
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	public function setTokenSecret($_tokenSecret){
	 	$this->_tokenSecret = $_tokenSecret;
	}
	/**
	 *	Método que executa uma requisição HTTP GET
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	public function get($path, $params = array()){
		$opt[CURLOPT_HTTPGET] = true;
	 	$request = $this->makeRequest($path, "GET", $opt, $params);
	 	return $request;
	}
	/**
	 *	Método que executa uma requisição HTTP POST
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	public function post($path, $params = array()){		
		$opt[CURLOPT_POST] = true;
		$opt[CURLOPT_POSTFIELDS] = $params;
	 	
		$request = $this->makeRequest($path, "POST", $opt, $params);
	 	
		return $request;
	}
	/**
	 *	Método que executa uma requisição HTTP PUT 
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	public function put($path, $arrData = array()){
		$arrData = self::setUtf8($arrData);
		$txt = json_encode($arrData);
		
		$putString = "str=".urlencode($txt);
		$putFile = tmpfile(); 
		fwrite($putFile, $putString); 
		fseek($putFile, 0); 

		$opt[CURLOPT_PUT] = true;
		$opt[CURLOPT_INFILE] = $putFile;
		$opt[CURLOPT_INFILESIZE] = strlen($putString);
	 	
		$request = $this->makeRequest($path, "PUT", $opt);
	 	
		fclose($putFile);
		
		return $request;
	}
	/**
	 *	Método que excuta uma requisição HTTP DELETE
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	public function delete($path){
		$opt[CURLOPT_CUSTOMREQUEST] = "DELETE";
	 	$request = $this->makeRequest($path, "DELETE", $opt);
	 	return $request;
	}
	/**
	 *	Método que encoda uma string para utf8
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 06/06/2011
	 *	@return 
	 */
	public static function setUtf8($arrData){
		foreach ($arrData as $key => $v) {
			if(is_array($v)){
				$arrData[$key] = self::setUtf8($v);
			} else {
				if($v){
					$arrData[$key] = utf8_encode($v);
				}
			}
		}
		return $arrData;
	}
	/**
	 *	Método que faz o request de uma url
	 *	@access private
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@return 
	 */
	private function makeRequest($path, $method = "GET", $opts = array(), $params = array()){	
		
		$url = $this->getUrlBase()."/".$path;
		
		/*
		 * oAuth
		 */
		$consumer = new OAuthConsumer($this->_consumerKey, $this->_consumerSecret);
		$token = new OAuthToken($this->_token, $this->_tokenSecret);
		
		$request = OAuthRequest::from_consumer_and_token($consumer, $token, $method, $url);
		
		foreach ($params as $name => $value) {
			$request->set_parameter($name, $value);
		}		
		
		$request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, $token);

		$oAuthHeader = $request->to_header();
		
	 	$ch = curl_init();
	 	/*
	 	 * Cabeçalho padrão
	 	 */
	 	$headers[] = 'Accept: application/json'; // options json, xml e php
	 	$headers[] = 'Expect:';
	 	$headers[] = $oAuthHeader;
	 	/*
	 	 * Paramêtros
	 	 */
	 	$opts[CURLOPT_URL] 			= $url;	 	
	 	$opts[CURLOPT_HTTPHEADER] 	= $headers;
	 	$opts[CURLOPT_RETURNTRANSFER] 	= true;
	 	$opts[CURLOPT_SSL_VERIFYPEER] 	= false;
	 	
	 	curl_setopt_array($ch, $opts);
	 	/*
	 	 * Execução
	 	 */
	 	$result = curl_exec($ch);
	 	
	 	if ($result === false){
	 		$e = new MapiException(
	 				array('error_code' => curl_errno($ch),
						  'error'      => array(
								'message' => curl_error($ch),
								'type'    => 'CurlException'
								)
							)
						);
			curl_close($ch);
			throw $e;
	 	} else {
	 		$arrResult = json_decode($result, true);
	 		if(isset($arrResult['response']['erro']) && $arrResult['response']['erro'] == 1){
	 			$e = new MapiException(
	 				array('error_code' => $arrResult['response']['status'],
						  'error'      => array(
								'message' => utf8_decode($arrResult['response']['mensagem']),
								'type'    => 'MapiException',
	 							'code'	  => $arrResult['response']['cod_erro']
								)
							)
						);
				curl_close($ch);
				throw $e;
	 		}
	 	}
	 	curl_close($ch);
	 	if(count($arrResult['result'])){
	 		return $arrResult['result'];
	 	} else {
	 		return utf8_decode($arrResult['response']['mensagem']);
	 	}
	}
}
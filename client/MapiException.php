<?
/**
 * Exception da API do MediaPost
 *
 * @copyright 2011 - MT4 Tecnologia
 * @author Diego Matos <diego@mt4.com.br>
 * @category MT4
 * @package MAPI
 * @since 16/03/2011
 */
class MapiException extends Exception {
	protected $result;
	/**
	 *	Método construtor
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 16/03/2011
	 *	@param Array request Resposta do API SERVER 
	 */
	public function __construct($result){
		$this->result = $result;
		$code = isset($result['error_code']) ? $result['error_code'] : 0;
		if (isset($result['error']) && is_array($result['error'])) {
			$msg = $result['error']['code']." - ".$result['error']['message'];
		} else {
			$msg = 'Unknown Error. Check getResult()';
		}

		parent::__construct($msg, $code);
	}
	
	/**
	 *	Método que retorna o array de exception
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 17/03/2011
	 *	@return 
	 */
	public function getResult(){
	 	return $this->result;
	}
	
	/**
	 *	Representação do erro como string
	 *	@access public
	 *	@author Diego Matos <diego@mt4.com.br>
	 *	@since 17/03/2011
	 *	@return 
	 */
	public function __toString(){
	 	$str = $this->result['error']['type'] . ' ';
	 	if ($this->code != 0) {
	 		$str .= $this->code . ': ';
	 	}
	 	return $str . $this->message;
	}
}
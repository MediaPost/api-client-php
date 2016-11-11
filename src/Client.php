<?php
/**
 * @copyright   2016 - MT4 Tecnologia
 * @author      Diego Matos <diego@mt4.com.br>
 * @author      Vinícius Campitelli <vsilva@mt4.com.br>
 * @category    MT4
 * @package     MAPI
 * @since       2011-03-16
 */

namespace Mapi;

/**
 * Classe cliente de acesso da API do MediaPost
 */
class Client
{
    /**
     * Consumer key do cliente
     *
     * @var string
     **/
    protected $consumerKey = null;

    /**
     * Consumer Secret do cliente
     *
     * @var string
     **/
    protected $consumerSecret = null;

    /**
     * Token do cliente
     *
     * @var string
     **/
    protected $token = null;

    /**
     * Token Secret do cliente
     *
     * @var string
     **/
    protected $tokenSecret = null;

    /**
     * URL da API
     *
     * @var string
     **/
    protected $url = 'https://api.mediapost.com.br';

    /**
     * Construtor
     *
     * @author Diego Matos <diego@mt4.com.br>
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2011-03-16
     *
     * @throws \RuntimeException Se alguma extensão necessária não estiver instalada
     *
     * @param  string $consumerKey    Consumer key do cliente
     * @param  string $consumerSecret Consumer Secret do cliente
     * @param  string $token          Token do cliente
     * @param  string $tokenSecret    Token Secret do cliente
     */
    public function __construct($consumerKey = null, $consumerSecret = null, $token = null, $tokenSecret = null)
    {
        // Verifica as dependências
        if (!\function_exists('curl_init')) {
            throw new \RuntimeException('Mapi\Client needs the CURL PHP extension.');
        }
        if (!\function_exists('json_decode')) {
            throw new \RuntimeException('Mapi\Client needs the JSON PHP extension.');
        }
        
        if ($consumerKey) {
            $this->setConsumerKey($consumerKey);
        }

        if ($consumerSecret) {
            $this->setConsumerSecret($consumerSecret);
        }

        if ($token) {
            $this->setToken($token);
        }

        if ($tokenSecret) {
            $this->setTokenSecret($tokenSecret);
        }
    }

    /**
     * Altera a URL base da API
     *
     * @author Diego Matos <diego@mt4.com.br>
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2011-03-17
     *
     * @param  string $url Nova URL
     *
     * @return self
     */
    public function setUrlBase($url)
    {
        $this->url = (string) $url;
        return $this;
    }

    /**
     * Retorna a URL Base da API
     *
     * @author Diego Matos <diego@mt4.com.br>
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2011-03-17
     *
     * @return string
     */
    public function getUrlBase()
    {
        return $this->url;
    }

    /**
     * Define o Consumer Key do cliente
     *
     * @author Diego Matos <diego@mt4.com.br>
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2011-03-16
     *
     * @param  string $consumerKey Valor do Consumer Key
     *
     * @return self
     */
    public function setConsumerKey($consumerKey)
    {
        $this->consumerKey = (string) $consumerKey;
        return $this;
    }

    /**
     * Retorna o Consumer Key do cliente
     *
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2016-11-04
     *
     * @return string
     */
    public function getConsumerKey()
    {
        return $this->consumerKey;
    }

    /**
     * Define o Consumer Secret do cliente
     *
     * @author Diego Matos <diego@mt4.com.br>
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2011-03-16
     *
     * @param  string $consumerSecret Valor do Consumer Secret
     *
     * @return self
     */
    public function setConsumerSecret($consumerSecret)
    {
        $this->consumerSecret = (string) $consumerSecret;
        return $this;
    }

    /**
     * Retorna o Consumer Secret do cliente
     *
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2016-11-04
     *
     * @return string
     */
    public function getConsumerSecret()
    {
        return $this->consumerSecret;
    }

    /**
     * Define o token do cliente
     *
     * @author Diego Matos <diego@mt4.com.br>
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2011-03-16
     *
     * @param  string $token Valor do Token
     *
     * @return self
     */
    public function setToken($token)
    {
        $this->token = (string) $token;
        return $this;
    }

    /**
     * Retorna o token do cliente
     *
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2016-11-04
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Define o token Secret do cliente
     *
     * @author Diego Matos <diego@mt4.com.br>
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2011-03-16
     *
     * @param  string $tokenSecret Valor do Token Secret
     *
     * @return self
     */
    public function setTokenSecret($tokenSecret)
    {
        $this->tokenSecret = (string) $tokenSecret;
        return $this;
    }

    /**
     * Retorna o token Secret do cliente
     *
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2016-11-04
     *
     * @return string
     */
    public function getTokenSecret()
    {
        return $this->tokenSecret;
    }
    
    /**
     * Magic call para os métodos da API
     *
     * @author Vinícius Campitelli <vsilva@mt4.com.br>
     * @since  2016-11-04
     *
     * @param  string $method Nome do método
     * @param  array  $args   Argumentos da requisição
     *
     * @return Response
     */
    public function __call($method, array $args)
    {
        $bridge = new Request\Request($this);
        return \call_user_func_array([$bridge, $method], $args);
    }
}

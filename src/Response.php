<?php
/**
 * @copyright   2016 - MT4 Tecnologia
 * @author      Diego Matos <diego@mt4.com.br>
 * @author      Vinícius Campitelli <vsilva@mt4.com.br>
 * @category    MT4
 * @package     MAPI
 * @since       2016-11-04
 */

namespace Mapi;

/**
 * Classe que executa uma requisição à API
 */
class Response extends Helper\ContainerAbstract
{
    /**
     * Campo que indica a quantidade de registros informados
     *
     * @var string
     */
    const TOTAL_COUNT = 'total_count';
    
    /**
     * Quantidade total de registros sem a paginação
     *
     * @var integer
     */
    protected $totalCount = 0;
    
    /**
     * Construtor
     *
     * @throws \InvalidArgumentException Se o parâmetro informado não for um recurso válido
     * @throws Exception Caso haja algum erro na requisição
     *
     * @param array  $arrResult Dados da requisição
     * @param array  $arrExtra  Dados extras (opcional)
     */
    private function __construct(array $arrResult, array $arrExtra = [])
    {
        // Verifica se a requisição estiver vazia
        if (empty($arrResult)) {
            throw new \InvalidArgumentException('Dados vazios.');
        }
                
        // Erro na requisição
        if (!empty($arrResult['response']['erro'])) {
            throw new Exception($arrResult['response']['status'], [
                'message' => \utf8_decode($arrResult['response']['mensagem']),
                'type'    => 'MapiException',
                'code'    => $arrResult['response']['cod_erro']
            ]);
        }
        
        // Se o resultado for vazio...
        if (empty($arrResult['result'])) {
            // ... verifica a mensagem de erro...
            if (isset($arrResult['response']['mensagem'])) {
                throw new Exception(500, [
                    'message' => \utf8_decode($arrResult['response']['mensagem']),
                    'type'    => 'MapiException',
                    'code'    => 500
                ]);
            }
            
            // ... ou lança um erro genérico
            throw new Exception(500, [
                'message' => 'Não foi possível processar a requisição.',
                'type'    => 'MapiException',
                'code'    => 500
            ]);
        }
        
        // Salva o resultado
        $this->data = $arrResult['result'];
        
        // Campos extras
        if (isset($arrExtra[self::TOTAL_COUNT])) {
            $this->totalCount = (int) $arrExtra[self::TOTAL_COUNT];
        }
    }
    
    /**
     * Retorna a quantidade total de registros no recurso, desconsiderando a paginação
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }
    
    /**
     * Retorna os dados da requisição em um array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
    
    /**
     * Cria um objeto a partir de um recurso do cURL
     *
     * @static
     * @throws \InvalidArgumentException Se o parâmetro informado não for um recurso válido
     * @throws Exception Caso haja algum erro na requisição
     *
     * @param  resource $ch Handler do cURL
     *
     * @return Response
     */
    public static function fromCurlResource($ch)
    {
        // Verifica o parâmetro
        if (!\is_resource($ch)) {
            throw new \InvalidArgumentException('O parâmetro informado não é um recurso válido.');
        }
        
        // Executa o cURL
        $response = \curl_exec($ch);
        $headerSize = \curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $result = \substr($response, $headerSize);
        
        // Se houver erro na requisição
        if (empty($result)) {
            $e = new Exception(\curl_errno($ch), [
                'message' => \curl_error($ch),
                'type'    => 'CurlException'
            ]);
            \curl_close($ch);
            throw $e;
        }
        
        // Fecha o cURL
        \curl_close($ch);
        
        // Processa o JSON
        $arrResult = \json_decode($result, true);
        if (empty($arrResult)) {
            throw new Exception(500, [
                'message' => 'Não foi possível processar a requisição.',
                'type'    => 'MapiException'
            ]);
        }
        
        // Separa os cabeçalhos
        $header = \substr($response, 0, $headerSize);
        
        return new Response($arrResult, self::parseHeaderString($header));
    }
    
    /**
     * Processa uma string com os cabeçalhos HTTP
     *
     * @static
     * @link http://stackoverflow.com/a/10590242/2116392
     *
     * @param  string $header Cabeçalhos HTTP a serem processados
     *
     * @return array          Cabeçalhos processados em um array
     */
    protected static function parseHeaderString($header)
    {
        $arrHeader = [];
        
        if (!empty($header)) {
            foreach (explode("\r\n", $header) as $i => $line) {
                if (($i) && (!empty($line))) {
                    list($key, $value) = explode(': ', $line);
                    if ($key == 'X-Total-Count') {
                        $arrHeader[self::TOTAL_COUNT] = (int) $value;
                        break;
                    }
                }
            }
        }
        
        return $arrHeader;
    }
}

<?php
/**
 * @copyright   2016 - MT4 Tecnologia
 * @author      Diego Matos <diego@mt4.com.br>
 * @author      Vinícius Campitelli <vsilva@mt4.com.br>
 * @category    MT4
 * @package     MAPI
 * @since       2016-11-11
 */

namespace Mapi\Request;

/**
 * Classe de configuração da requisição
 */
class Config
{
    /**
     * Define o range de elementos desejados
     *
     * @var string
     */
    const RANGE = 'range';
    
    /**
     * Dados de configuração
     *
     * @var array
     */
    private $arr = [];
    
    /**
     * Construtor
     *
     * @param array $arr Dados da configuração
     */
    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }
    
    /**
     * Constrói os cabeçalhos de acordo com a configuração informado
     *
     * @param  array  $arr Dados da configuração
     *
     * @return array
     */
    protected function build(array $arr)
    {
        $headers = [];
        
        // HTTP Range da requisição
        if (isset($arr[self::RANGE])) {
            $range = $arr[self::RANGE];
            if (\is_array($range)) {
                $start = (isset($range[0])) ? \max((int) $range[0], 0) : -1;
                $end   = (isset($range[1])) ? \max((int) $range[1], 0) : -1;
            } else {
                $start = $end = -1;
            }
            if (($start < 0) || ($end < 0)) {
                throw new \InvalidArgumentException('Range inválido.');
            }
            
            // Adiciona o cabeçalho
            $headers[] = "Rest-Range: {$start}-{$end}";
        }
        
        return $headers;
    }
    
    /**
     * Retorna os cabeçalhos
     *
     * @return array
     */
    public function toArray()
    {
        return $this->build($this->arr);
    }
}

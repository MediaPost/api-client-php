<?php
/**
 * @copyright   2016 - MT4 Tecnologia
 * @author      Diego Matos <diego@mt4.com.br>
 * @author      Vinícius Campitelli <vsilva@mt4.com.br>
 * @category    MT4
 * @package     MAPI
 * @since       2016-11-04
 */

namespace Mapi\Helper;

/**
 * Classe que implementa as interfaces necessárias para lidar com o objeto como se fosse um array
 *
 * @abstract
 */
abstract class ContainerAbstract implements \Iterator, \ArrayAccess, \Countable
{
    /**
     * Dados da resposta
     *
     * @var array
     */
    protected $data = [];
        
    /**
     * Retorna os dados
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
        
    /**
     * Retrocede o ponteiro interno do array, usado pelo Iterator
     *
     * @return self
     */
    public function rewind()
    {
        \reset($this->data);
        return $this;
    }

    /**
     * Retorna o elemento da posição atual, usado pelo Iterator
     *
     * @return mixed
     */
    public function current()
    {
        return \current($this->data);
    }

    /**
     * Retorna a chave atual do array, usado pelo Iterator
     *
     * @return mixed
     */
    public function key()
    {
        return \key($this->data);
    }

    /**
     * Avança o ponteiro interno, usado pelo Iterator
     *
     * @return self
     */
    public function next()
    {
        \next($this->data);
        return $this;
    }

    /**
     * Verifica se a posição atual é válida, usado pelo Iterator
     *
     * @return boolean
     */
    public function valid()
    {
        $key = $this->key();
        return isset($this->data[$key]) || \array_key_exists($key, $this->data);
    }
    
    /**
     * Seta um elemento na posição especificada, utilizado pela interface ArrayAccess
     *
     * @param  int   $offset Offset
     * @param  mixed $value  Valor a ser setado
     *
     * @retun self
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
        return $this;
    }

    /**
     * Verifica se o offset especificado existe, utilizado pela interface ArrayAccess
     *
     * @param  mixed $offset Offset desejado
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]) || \array_key_exists($offset, $this->data);
    }

    /**
     * Remove o elemento no offset especificado, utilizado pela interface ArrayAccess
     *
     * @param  mixed $offset Offset desejado
     *
     * @return self
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
        return $this;
    }

    /**
     * Retorna o elemento no offset desejado, utilizado pela interface ArrayAccess
     *
     * @param  mixed $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
    
    /**
     * Retorna a quantidade de registros retornados, utilizado pela interface Countable
     *
     * @return integer
     */
    public function count()
    {
        return \count($this->data);
    }
}

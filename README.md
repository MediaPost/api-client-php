# @MediaPost API - Cliente PHP

## Instalação
### Via composer
Altere o *require* de seu `composer.json` e baixe a dependência com `composer update mediapost/api-client-php`:
```json
{
  "require": {
    "mediapost/api-client-php": "^1.1.0"
  }
}
```
Ou adicione diretamente a dependência com `composer require mediapost/api-client-php:^1.1.0`.

### Manual
1. Baixe a [última versão](https://github.com/MediaPost/api-client-php/releases/latest) desse cliente e descompacte-a no diretório de sua aplicação
2. Crie um sistema de *autoloading* ou utilize algum pronto
3. Inicialize normalmente o cliente

## Código
### Inicialização
```php
<?php
// Autoloading do composer ou outro à sua escola
require 'vendor/autoload.php';

// Instanciando o client
$mapi = new Mapi\Client(
    '' /* $ConsumerKey */,
    '' /* $ConsumerSecret */,
    '' /* $Token */,
    '' /* $TokenSecret */
);
```

### Requisições
```php
<?php
// Inicialização do cliente ...

try {
    // Requisições GET
    $response = $mapi->get('url/do/recurso');

    // Requisições DELETE
    $response = $mapi->delete('url/do/recurso');

    // Requisições POST
    $response = $mapi->post('url/do/recurso', [
        'campo' => 'valor',
        'campo2' => 'valor2'
    ]);

    // Requisições PUT
    $response = $mapi->put('url/do/recurso', [
        'campo' => 'valor',
        'campo2' => 'valor2'
    ]);
} catch (Mapi\Exception $e) {
    // Erro de requisição
    var_dump($e);
} catch (Exception $e) {
    // Erro genérico (por exemplo, parâmetros inválidos)
    var_dump($e);
}
```

### Respostas
Todas as requisições retornam um objeto do tipo `Mapi\Response`.
```php
<?php
// Inicialização do cliente ...

// Retorna a quantidade de registros que o recurso pode retornar (desconsiderando a paginação)
var_dump($response->getTotalCount());

// Essa classe se comporta como um array...

// ... podendo ser iterada...
foreach ($response as $key => $value) {
    var_dump($key, $value);
}

// ... e também acessada
var_dump(count($response));
var_dump($response['key']);

// Se preferir lidar realmente com um array, basta invocar o método toArray()
$arr = $response->toArray();
```

## Credenciais
Para acessar a API, você irá precisar das quatro credenciais de acesso: _Consumer Key, Consumer Secret, Token_ e _Token Secret_.

Para requisitar esses dados, você deve entrar em contato com a equipe de Suporte, criando um chamado através de sua conta @MediaPost.

## Testes
A pasta _tests_ possui alguns arquivos para exemplificar o consumo dos recursos.

Antes de acessar algum desses testes, você precisará modificar as credenciais encontradas no arquivo _conf.php_ nessa mesma pasta.

Toda a documentação está disponível em https://www.mediapost.com.br/api/.

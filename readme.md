# Lottery API

Este projeto implementa uma API para gerar e verificar bilhetes de loteria. Foi construído em PHP, com Docker para facilitar a configuração e execução do ambiente. A API permite realizar sorteios, gerar bilhete ganhador e validar bilhete.

## Tecnologias Utilizadas

- **PHP**: Desenvolvimento da API.
- **Docker**: Para ambiente isolado.
- **Postman**: Testes da API.
- **PHPUnit**: Testes automatizados.

## Funcionalidades

### 1. **Lottery (Sorteio)**

- **Generate Winning Ticket**: Gera um bilhete vencedor (`GET /generate-winning-ticket`).
- **Generate Tickets**: Gera múltiplos bilhetes aleatórios (`POST /generate-tickets`).
- **Check Tickets**: Verifica se os bilhetes gerados correspondem ao bilhete vencedor (`GET /check-tickets`).


## Como Iniciar o Projeto

### Requisitos

- **Docker** e **Docker Compose** instalados.

### Rodando a Aplicação

1. Clone o repositório:
    ```bash
    git clone sistema_loteria
    cd sistema_loteria
    ```

2. Construa e inicie os containers:
    ```bash
    docker compose up --build
    ```

3. A aplicação estará disponível em `http://localhost:8000`.

### Rodando os Testes

1. Para rodar os testes com PHPUnit dentro do container:
    ```bash
    composer test
    ```
   
### Postman Collection

Importe a [Postman Collection](https://www.postman.com/) para testar os endpoints.

1. Abra o Postman e clique em "Import".
2. Selecione "Raw Text" e cole o conteúdo do arquivo `lottery-api.postman_collection.json`.
3. Clique em "Import" para adicionar a coleção ao Postman.

## Estrutura do Docker

O Docker está configurado no arquivo `docker-compose.yml`, que define o serviço:

- **app**: Contém a aplicação PHP com a porta `8000` exposta.


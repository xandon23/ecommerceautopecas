# Nome do Projeto: Sistema de Gestão de Vendas
## Descrição do Sistema
Este é um pequeno sistema de gestão de vendas, desenvolvido como projeto prático do curso de Tecnologia, Análise e Desenvolvimento de Sistemas. O seu principal objetivo é aplicar os conhecimentos de PHP com Orientação a Objetos (POO), utilizando o padrão de arquitetura MVC (Model-View-Controller) e a biblioteca Doctrine ORM para a manipulação de um banco de dados MySQL.

## O sistema permite:

Autenticação de utilizadores (login).

Gestão de produtos (cadastro).

Registo de vendas com múltiplos itens.

Relatórios de vendas, com a visualização do histórico e detalhes de cada transação.

## Instruções de Instalação e Execução:
Siga os passos abaixo para configurar e executar a aplicação no seu ambiente local.

- Pré-requisitos:

Servidor web (Apache ou Nginx) com PHP 8.1+

MySQL 8.0+

Composer

- Configuração do Banco de Dados:

Crie um banco de dados MySQL com o nome sistema_vendas_db.

Execute o seguinte comando na raiz do projeto para criar as tabelas a partir das entidades do Doctrine:
```
composer create-db
```
- Instalação das Dependências

Na raiz do projeto, execute o comando para instalar todas as bibliotecas PHP necessárias:
```
composer install
```
- Execução da Aplicação

Abra o terminal na pasta public e inicie o servidor interno do PHP:
```
composer start
```
Em seguida, aceda à aplicação no seu navegador: http://localhost:8000

## Membros da Equipe:
- Alexandre de Jesus Gonçalves - RA: 20.2840-5

DER (Diagrama de Entidade-Relacionamento)
A estrutura do banco de dados do projeto é a seguinte:
https://drive.google.com/file/d/1qlwdYXGIoXkYZUt_qldnQEFYJ-rNAmWk/view?usp=sharing
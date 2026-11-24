# Controle de Estoque

Sistema web de controle de estoque e gerenciamento de produtos desenvolvido em PHP, MySQL e Bootstrap.

## Sobre o Projeto

Este projeto tem como objetivo facilitar o acompanhamento e a organização de produtos em estoque, permitindo o cadastro, a atualização, a consulta e a exclusão de itens de forma rápida, segura e intuitiva.

A aplicação conta com controle de acesso protegido por autenticação via Cookies (`HttpOnly` e `SameSite`), painel resumido com indicadores de quantidade e alertas visuais automáticos para produtos que atingem ou ficam abaixo do estoque mínimo configurado.

## Funcionalidades

### Autenticação e Segurança
- Tela de login com validação de credenciais no banco de dados (`password_verify()`)
- Controle de sessão via Cookie assinado com HMAC (`HttpOnly` e `SameSite=Lax`)
- Encerramento seguro de sessão (Logout) e bloqueio de acesso direto às páginas internas

### Painel Inicial (Dashboard)
- Exibição do total de itens cadastrados no sistema
- Contador e alerta visual imediato para produtos em estoque mínimo ou abaixo
- Atalhos rápidos para listagem e cadastro de novos produtos

### Gerenciamento de Itens (CRUD)
- Listagem completa dos produtos com código SKU, nome, quantidade atual, estoque mínimo e badge de status (*Normal* ou *Estoque Baixo*)
- Cadastro de novos itens com validação de campos
- Edição e atualização de quantidades e dados dos produtos
- Exclusão de itens com janela de confirmação preventiva

## Tecnologias Utilizadas

- PHP 8+ (PDO)
- MySQL / MariaDB
- HTML5
- CSS3
- Bootstrap 5
- Git e GitHub

## Desenvolvedores

- Ana Clara de Melo Oliveira
- Maísa Pinheiro Ferreira
- Farley

## Objetivo

Projeto acadêmico desenvolvido no curso de Bacharelado em Sistemas de Informação — IFNMG Campus Januária, aplicando na prática conceitos de desenvolvimento web back-end e front-end, persistência de dados relacional com PDO, autenticação segura por Cookies e versionamento colaborativo em equipe com Git e GitHub.

## Status

Em desenvolvimento

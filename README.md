<h1 align="center">
Store credit API
</h1>

<h4 align="center">
Projeto para listar o score de cada pessoa
</h4>

<p >Este projeto tem a ideia de listagem de cada usuário  pelo CPF é as tecnologias escolhidas para esta aplicação foram as seguintes:</p>


## Tecnologias

- [Laravel](https://laravel.com/)
- [Mongodb](https://www.mongodb.com/3)
- [Laravel-mongodb](https://github.com/jenssegers/laravel-mongodb)
- [Node.js](https://nodejs.org/en/)
- [Redis](https://redis.io/)
- [Express](https://expressjs.com/)
- [Nodemon](https://nodemon.io/)
- [Axios](https://github.com/axios/axios)

## Tecnologias escolhidas

<p>A tecnologia está sempre em constante evolução por isso cada vez mais é difícil escolher a melhor ou a mais rápida, mas para este projeto foi escolhido o mongo por sua facilidade e velocidade na leitura dos seus dados, foi utilizado o Laravel para conexão do mongo e tratamento dos seus dados, O Node.js foi utilizado como se fosse um <i>Mediator</i> orquestrando as respostas entregada pela api feita em laravel, mas para acelerar a sua velocidade foi utilizado o banco Redis, O Redis é famoso em sua armazenação em memória tornando uma aplicação muito mais rápida.</p>

<p>Portanto toda vez que a aplicação é chamada pela primeira ela vai até o laravel com o mongo para buscar aquilo que o cliente esta pedindo, já na segunda vez que o cliente chamar o serviço de novo com o mesmo payload o Node.js invés de ir até o laravel para buscar as informações ele vai acessará redis entregando muito mais rápido a informação. Como ilustra a imagem a baixo.</p>


![alt text](https://github.com/Lvitoria/score-credit/blob/master/fluxo.png?raw=true)


## Instalando e rodando os projetos

1. start o Redis e o mongo
2. entre na pasta credit e execute o comando  <span style="color:Grey;">composer install</span> espere um pouco, depois crie o arquivo `.env` que tem como exemplo `.env.example` e para rodar use o comando `php artisan serve`
3. Crie as collections no mongo com o comando `php artisan migrate`
4. entre na pasta scoreOrganizet e execute o comando  `npm i` espere um pouco, depois cria o arquivo `.env` que tem como exemplo `.env.example` e para rodar use o comando `npm run dev`
5. Na raiz do projeto vai ter a collection com todas os endpoints, pode importar para seu postman ou insonia.


### Observações

 A coleção com o nome `user` são referentes a tabela usuários que criei, pois todos os usuários que quiserem ver as informações dos endpoints `baseB` e `baseC` tem que estar autenticados então estes endpoints tem que passar um token para eles, reforçando assim a segurança.

A criptografia utilizada foi o base 64, mas o mais correto seria criar uma própria criptografia, mas devido ao tempo não consegui criar um algoritmo próprio de criptografia.

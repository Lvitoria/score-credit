<h1 align="center">
Store credit API
</h1>

<h4 align="center">
Projeto para listar o score de cada pessoa
</h4>

<p >Este projeto tem como ideia a listagem de cada usuário  pelo CPF, as tecnologias escolhidas para esta aplicação foram as seguintes:</p>


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

<p>As tecnologias estão em constante evolução, por isso cada vez mais a tarefa de definir a melhor ou a mais veloz ferramenta vem se tornando difícil ou mesmo quase impossível em meio a tantas possibilidades, mas para este projeto foi escolhido o mongo por sua facilidade e velocidade na leitura dos seus dados, foi utilizado o Laravel para conexão do mongo e tratamento dos seus dados. O Node.js foi utilizado como se fosse um 'Mediator' orquestrando as respostas entregada pela api feita em laravel, mas para acelerar a sua velocidade foi utilizado o banco Redis. O Redis é famoso por sua armazenação em memória, tornando uma aplicação muito mais rápida, ja que 'cacheia' as buscas, fazendo as requisições seguintes serem muito mais ágeis.</p>

<p>Portanto, o fluxo funciona da seguinte forma: toda vez que a aplicação é chamada pela primeira ela vai até o laravel com o mongo para buscar aquilo que o cliente esta solicitando, já na segunda vez que o cliente chamar o serviço, com o mesmo payload, o Node.js não fará mais o mesmo trajeto, de ir até o laravel para buscar as informações, ele acessará Redis entregando muito mais rápido a informação. Como ilustra a imagem a baixo.</p>


![alt text](https://github.com/Lvitoria/score-credit/blob/master/fluxo.png?raw=true)


## Instalando e rodando os projetos

1. start o Redis e o mongo
2. entre na pasta credit e execute o comando  `composer install` espere um pouco, depois crie o arquivo `.env` que tem como exemplo `.env.example` e para rodar use o comando `php artisan serve`
3. Crie as collections no mongo com o comando `php artisan migrate`
4. entre na pasta scoreOrganizet e execute o comando  `npm i` espere um pouco, depois cria o arquivo `.env` que tem como exemplo `.env.example` e para rodar use o comando `npm run dev`
5. Na raiz do projeto vai ter a collection com todas os endpoints, pode importar para seu postman ou insonia.


### Observações

 A coleção com o nome 'user' são referentes a tabela usuários que criei, pois todos os usuários que quiserem ver as informações dos endpoints `baseB` e `baseC` tem que estar autenticados então estes endpoints devem passar um token para eles, reforçando assim a segurança.

A criptografia utilizada foi o base 64, porém, a intenção inicial era criar uma criptografia própria para maior segurança, e devido ao curto período de tempo, não foi possível criar um algoritmo próprio para tal

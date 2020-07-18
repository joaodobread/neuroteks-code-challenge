# API - News

### Organização

[Voltar](../README.md)

-   A aplicação é toda orientada a objetos sendo possível crecimento e adição de novas rotas
-   Sistema de rotas, banco de dados e controle de erros
-   Foi criado um mini framework, onde pode-se adicionar novas rotas, recursos etc.

---

-   Foi utilizado o padrão da `psr-4` para fazer o sistema de autoload via `composer`

-   Separada em partes onde a pasta `Core` é a pasta que faz a lógica de funcionamento base a aplicação

-   Os recursos dos `controllers` só podem ser acessados pelo método e rota definida para ele. Caso não seja encontrada ira retornar um erro.

-   Foi reescrito o `ErrorHandler` padrão do `php` para que todos os erros sejam formatados e retornados em forma de `json`

---

# Organização de arquivos

---

-   A pasta `App` é o diretório principal. Onde está contido todos os arquivos da aplicação

-   A pasta `App/Config` é onde estão armazenados as configurações necessárias para funcionamento.

-   Em `App/Core` é localizado o coração da aplicação e onde é definido os tipos, classes e lógica inicial para a criação das rotas, controladores.

-   `Model` é a pasta onde fica a definição dos objetos que representam tabelas no banco de dados.

-   O arquivo `Routes` é onde será declarado todas as rotas da aplicação. Fazendo o uso de notação `<recurso>Controler.<método>` que será automaticamente chamado quando for necessário.

-   `index.php` é o arquivo _`bootstrap`_ da aplicação, onde se inicia tudo.

---

# Informações adicionais

-   A classe `Rest` e `Router` faz uso do modelo _singleton_.

-   Para se ter acesso a uma tabela no banco de dados usa-se de `Repository` que é uma classe que estende `Model`. Já tendo alguns métodos implementados por padrão.

-   Todos os `Controllers` criados devem estender o arquivo `Core/Controller` e implementar 5 métodos.

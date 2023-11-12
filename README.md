# Todo App

Bem-vindo ao Todo App! Este é um aplicativo simples de lista de tarefas desenvolvido com Laravel e Vue.js

![image](https://github.com/JuniorLopes09/todo-app/assets/62529285/fa9cf758-8c4f-4dd4-bccf-b08cc05fa3f3)


## Requisitos

Certifique-se de ter os seguintes requisitos instalados antes de prosseguir:

- [Git](https://git-scm.com/)
- [Docker](https://www.docker.com/)

## Configuração do Projeto

1. **Clonar o repositório:**

   ```bash
   git clone https://github.com/JuniorLopes09/todo-app.git
   ```
2. **Copiar o arquivo de ambiente:**
    ```bash
    cp .env.example .env
    ```
   OBS: Abra o arquivo .env e configure as variáveis de ambiente, se necessário.


3. **Levantar a instância do Docker:**

    ```bash
    docker-compose up -d 
    ```

4. **Baixar as dependências do projeto:**
    ```bash
    docker-compose exec laravel.test composer install && npm install
    ```
5. **Realizar o build das views:**
    ```bash
    docker-compose exec laravel.test npm run build
    ```
6. **Levantar a aplicação com Sail:**
    ```bash
    ./vendor/bin/sail up -d
    ```
## Acesso à Aplicação
Depois de concluir os passos acima, acesse a aplicação em http://todo-app.test

## Comandos Úteis
1. **Levantar a aplicação com Sail:**
    ```bash
    ./vendor/bin/sail up -d
    ```
2. **Derrubar a aplicação:**
    ```bash
    ./vendor/bin/sail down
    ```
3. **Visualizar logs da aplicação:**
    ```bash
    ./vendor/bin/sail logs
    ```
## Contribuição
Sinta-se à vontade para contribuir ou relatar problemas!



   

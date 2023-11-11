# Todo App

Bem-vindo ao Todo App! Este é um aplicativo simples de lista de tarefas desenvolvido com Laravel e Vue.js.\

![image](https://github.com/JuniorLopes09/todo-app/assets/62529285/fa9cf758-8c4f-4dd4-bccf-b08cc05fa3f3)


## Requisitos

Certifique-se de ter os seguintes requisitos instalados antes de prosseguir:

- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [Docker](https://www.docker.com/)

## Configuração do Projeto

1. **Clonar o repositório:**

   ```bash
   git clone https://github.com/JuniorLopes09/todo-app.git
   ```
   
2. **Instalar dependências PHP com Composer:**

    ```bash
    composer install
    ```
    
3. **Instalar dependências JavaScript com npm:**

    ```bash
    npm install
    ```

4. **Copiar o arquivo de ambiente:**
    ```bash
    cp .env.example .env
    ```
    OBS: Abra o arquivo .env e configure as variáveis de ambiente, se necessário.

5. **Compilar os recursos JavaScript e CSS:**
    - Para desenvolvimento:
    ```bash
    npm run dev
    ```
    - Para produção:
    ```bash
    npm run build
    ```
6. **Levantar a aplicação com Sail:**
    ```bash
    ./vendor/bin/sail up -d
    ```
7. **Executar as migrações e popular o banco de dados:**
    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```
## Acesso à Aplicação
Depois de concluir os passos acima, acesse a aplicação em http://localhost ou http://todo-app.test

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



   

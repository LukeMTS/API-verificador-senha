Neste projeto, foi utilizado Laravel para API e Docker.

1. Realizar uma cópia do .env.example e renomear esta cópia para apenas .env

2. Acessar o terminal e rodar os seguintes comandos no diretório do projeto: 
    - docker-compose up -d
    - docker-compose exec web bash
    - cd /usr/share/nginx
    - composer install
    - php artisan key:generate
    - chown nginx:nginx -R .
    - rm -rf /usr/share/nginx/html
    - ln -s public html

3. Agora é necessário ajeitar uma configuração do nginx:
    - nano /etc/nginx/conf.d/default.conf

    Na linha que diz: 
        try_files $uri $uri/ /index.php?$query_string $uri/index.html;
    Alterar para:
        try_files $uri $uri/ /index.php?$query_string;

    - Ctrl + X para sair
    - Y para salvar
    - Enter para manter o nome
    - Reinicie nginx

4. Faça uma requisição POST para http://localhost:8080/api/verify
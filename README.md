# Para usar o projeto faça os seguintes paços.

### 1º baixe o projeto diretamente do github. 
https://github.com/Rezsende/desafio-backend-pigz.git;

### 2º tenha o composer instalado e rode o seguinte comando no bash. 
composer install

### 3º para verificar se deu certo, digite na url do seu navegado
http://127.0.0.1:8000/

### 4º Tem quer ter o docker instalado na sua maquina, rode o seguinte comando no bash.
docker-compose up -d --build

### 5º executar as imigrações do banco de dados.
1. docker compose  exec php bash
2. rm -f  migrations/Version*.php
3. php bin/console make:migration
4. php bin/console doctrine:migrations:migrate

### 6º Acessa gerenciado de bancos de dados adminer. 
http://localhost:8082/

**Login:**

- **Servidor:** database  
- **Usuário:** root  
- **Senha:** root  
- **Base de dados:** app

### comando para enserir um usuario.
`
INSERT INTO usuario  (
    email,
    senha,
    nivel_acesso,
    data_criacao,
    data_atualizacao
) VALUES (
    'jpresendejava@gmail.com',
    '1234567',
    'admin',
    NOW(),
    NOW()
);

`
# Endpoints
### Criar Usuario com base no nivel de acesso seja admin

método: POST = http://localhost:8000/api/usuarios/2

### Criar Listas

método: POST = http://localhost:8000/api/usuarios/1/listas

### Deletar uma Lista com Items dentro dela

método: DELETE = http://localhost:8000/api/listas/1

### Add Item na lista

método: POST = http://localhost:8000/api/listas/1/itens

### Deletar items com Items

método: DELETE = http://localhost:8000/api/items/4

### concluir tarefa

método: PATCH = http://localhost:8000/api/items/7/concluida

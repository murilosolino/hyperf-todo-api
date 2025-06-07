# 📝 Hyperf TODO API

## 🚀 Tecnologias
 
- **Docker + Docker Compose** – ambiente containerizado  
- **MySQL** – via container, usando migrations  
- **PHP** 
- **HYPERF**
---

## 🧩 Funcionalidades da API

| Método | Rota              | Descrição                    |
|:------:|:-----------------:|:-----------------------------|
| POST   | `/tasks`          | Criar uma nova tarefa        |
| GET    | `/tasks`          | Listar todas as tarefas      |
| GET    | `/tasks/{id}`     | Obter tarefa por ID          |
| PUT    | `/tasks/{id}`     | Atualizar tarefa existente   |
| DELETE | `/tasks/{id}`     | Excluir tarefa               |

- Retorno em JSON com status HTTP apropriado
- Controle de erros com respostas padronizadas (404, 422, 500)
- Disponibilização de filtros no endpoint tasks para buscar tarefas por **title** e **is_done**

---

## 🧰 Pré-requisitos

- Docker e Docker Compose
- (Opcional, para dev local sem Docker) PHP 8.1+ com extensões: Swoole, pdo_mysql, json, pcntl

---

## ⚙️ Instalação e execução

1. **Clone o repositório**

    ```bash
    git clone https://github.com/murilosolino/hyperf-todo-api.git
    cd hyperf-todo-api
    ```

2. **Copie o arquivo de ambiente**

    ```bash
    cp .env.example .env
    ```

3. **Suba os containers**

    ```bash
    docker-compose up -d
    ```

4. **Execute as migrations**

    ```bash
    docker-compose exec app php bin/hyperf.php migrate
    ```

5. **Acesse a API**

    ```
    http://localhost:9501
    ```

---

## 📘 Exemplos com cURL

- **Criar tarefa**

    ```bash
    curl -X POST http://localhost:9501/tasks \
      -H "Content-Type: application/json" \
      -d '{
            "title":"Estudar Hyperf",
            "description":"Criar um projeto para estudar Hyperf",
            "is_done":0
            }'
    ```

- **Listar tarefas**

    ```bash
    curl http://localhost:9501/tasks
    ```

    **Listar tarefas com filtros**

    ```bash
    curl http://localhost:9501/tasks?title=teste&is_done=0
    ```

- **Obter tarefa por ID**

    ```bash
    curl http://localhost:9501/tasks/1
    ```

- **Atualizar tarefa**

    ```bash
    curl -X PUT http://localhost:9501/tasks/1 \
      -H "Content-Type: application/json" \
      -d '{"title":"Revisar PR", "is_done":1}'
    ```

- **Excluir tarefa**

    ```bash
    curl -X DELETE http://localhost:9501/tasks/1
    ```

---

## 🤝 Contribuindo

Contribuições são bem‑vindas! Para colaborar:

1. Faça um *fork* do repositório  
2. Crie uma branch (`git checkout -b feature/minha-nova-funcionalidade`)  
3. Adicione testes e documentação  
4. Faça commit e envie um *pull request*

---

## 📄 Licença

Distribuído sob a licença **MIT**. Veja o arquivo `LICENSE` para mais detalhes.

---

## 🧑‍💻 Sobre o autor

@murilosolino — graduando em Ciência da Computação, desenvolvendo habilidades em APIs, microsserviços e back-end moderno.


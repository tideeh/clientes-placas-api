# Clientes Placas — API REST

API REST em **Laravel + Docker** para cadastro de **clientes** e suas respectivas **placas de carro**.

## Tecnologias
- [PHP 8.2](https://www.php.net/) + [Laravel 12](https://laravel.com/)
- [MySQL 8](https://www.mysql.com/)
- [Nginx](https://www.nginx.com/)
- [Docker](https://www.docker.com/)

---

## Instalação

### Pré-requisitos
- Docker Desktop (Win/Mac) ou Docker Engine 24+ (Linux)
- Git
- (Windows) usar **PowerShell** ou **WSL**.

### Passo a passo
```bash
# clonar o projeto
git clone https://github.com/tideeh/clientes-placas-api.git clientes-placas-api
cd clientes-placas-api

# subir containers
docker compose up -d --build

# instalar dependências Laravel
docker compose exec app bash -lc "cd /var/www/html && composer install --no-interaction --prefer-dist"

# preparar .env, chave e permissões
docker compose exec app bash -lc "cd /var/www/html && \
  [ -f .env ] || cp .env.example .env && \
  sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env && \
  sed -i 's/^DB_HOST=.*/DB_HOST=db/' .env && \
  sed -i 's/^DB_PORT=.*/DB_PORT=3306/' .env && \
  sed -i 's/^DB_DATABASE=.*/DB_DATABASE=clientes_placas_api/' .env && \
  sed -i 's/^DB_USERNAME=.*/DB_USERNAME=app/' .env && \
  sed -i 's/^DB_PASSWORD=.*/DB_PASSWORD=app/' .env && \
  php artisan key:generate --force && \
  chown -R www-data:www-data storage bootstrap/cache && \
  chmod -R ug+rwX storage bootstrap/cache"

# rodar migrações
docker compose exec app php artisan migrate --force

# inserir valores iniciais no banco: 
docker compose exec app php artisan db:seed

```
## Testes com Postman

Uma collection do Postman está disponível em [`docs/CLIENTES-PLACAS-API.postman_collection.json`](docs/CLIENTES-PLACAS-API.postman_collection.json).

Para usar:
1. Abra o Postman
2. Importe o arquivo


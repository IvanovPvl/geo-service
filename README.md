## Geo IP service

Установка:

```bash
git clone https://github.com/IvanovPvl/geo-service.git
cd geo-service/
cp .env.example .env
```

В .env установить необходимые APP_ENV, APP_KEY 

```bash
cd data/
tar -xzvf data.tar.gz
cd ../docker/
docker-compose -f docker-compose.dev.yml up -d
docker-compose -f docker-compose.dev.yml exec geo_workspace bash
composer install
php artisan migrate
php artisan db:seed
```

Развернутый сервис доступен по адресу:
[http://78.155.207.19/ip2geo?ip=111.111.111.111](http://78.155.207.19/ip2geo?ip=111.111.111.111)
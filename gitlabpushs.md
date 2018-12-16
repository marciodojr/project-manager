
docker run --interactive --tty -v $PWD:/app --user $(id -u):$(id -g) composer create-project laravel/laravel

## Local Tunnel

```
npm install -g localtunnel
```

## Running Local Tunnel

```
lt --port 8080 --subdomain=pm-incluir
```


## Tasks

- [x] Criar Rota (controller)
```
php artisan make:controller Gitlab/Pushes --api
```

- [x] Testar rota

```
curl -d "param1=value1&param2=value2" -X POST https://pm-incluir.localtunnel.me/gitlab/pushes
```


- [x] Criar Model (migração, seed e factory)

```
php artisan make:model Push -m -f
php artisan make:seeder PushSeeder
php artisan migrate:fresh --seed
```

```php
$table->string('repository_name');
$table->string('pusher');
$table->timestamp('pushed_at');
$table->integer('number_of_commits');
```

- [x] Testar os dados

```
php artisan tinker
\App\Entity\Push::first();
```

- [x] Registrar webhook
- [x] Testar


```
php artisan key:generate
chmod a+w storage -R
```
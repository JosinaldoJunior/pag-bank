<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Project

This project is an API for a payments system developed in PHP, using the Laravel framework.

### Technologies

- **[PHP8](https://vehikl.com/)**
- **[Laravel 10](https://laravel.com/docs/10.x)**
- **[Docker](https://docs.docker.com/guides/)**
- **[Mysql](https://www.mysql.com/)**
- **[PHPUnit](https://phpunit.de/index.html)**
- **[Swagger](https://swagger.io/docs/)**

## Running local application

1 - First clone the project repository:
```
git clone https://github.com/JosinaldoJunior/pag-bank.git
```
`Afterwards, access the folder where the project was cloned`

2 - Create `.env` file from `.env-example`:
```
cp .env .env-example
```

3 - Execute command to initialize application containers:
```
make up
```

4 - Run the command to install the application dependencies:
```
make install
```

5 - Run the command to create the application database:
```
make migrate
```

After that, access http://localhost:8005.

`Obs.: If you need to clean the database, run the command below:`
```
make migrate-fresh
```

## Running tests

```
make test
```

## API documentation

- **[Swagger](http://localhost:8005/api/documentation)**
- **Collection - /PagBankAPI.postman_collection.json**

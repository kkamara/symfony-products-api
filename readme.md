<img src="https://github.com/kkamara/useful/raw/main/php-react-boilerplate.png" alt="php-react-boilerplate.png" width=""/>

<img src="https://github.com/kkamara/useful/raw/main/php-react-boilerplate2.png" alt="php-react-boilerplate2.png" width=""/>

# symfony-products-api

This repository follows Dave Hollingworth's course Symfony RESTful API at https://www.youtube.com/watch?v=jsEcndTOcMU .

## Using Postman?

[Get Postman HTTP client](https://www.postman.com/).

[Postman API Collection for Symfony Products API](./symfony-products-api.postman_collection.json).

## Installation

* [PHP](https://herd.laravel.com)
* [Composer](https://getcomposer.org)
* [Symfony](https://symfony.com/doc/current/setup.html)

```bash
composer i
bin/console doctrine:migrations:migrate
```

## Usage

```bash
symfony server:start
```

## Inline SQL

```bash
bin/console dbal:run-sql "SELECT * FROM product"
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[BSD](https://opensource.org/licenses/BSD-3-Clause)

# Potato ORM

[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]

A simple agnostic Object Relational Mapper(ORM) in PHP 

## Install

Via Composer

``` bash
$ composer require ooduye/potato-orm
```

## Usage

``` php
//To retrieve data
$user = User::getAll();
print_r($user);

// To insert data
use Yemisi\Task;
$task = new Task();
$task->name = "Eat";
$task->description = "By 12, I must eat rice";
$task->save();

//To update data
$task = new Task();
$thing = $task::find(2);
$thing->name = "Consume";
$thing->save();

//To delete data
$car = Car::destroy(1);


```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email oluwayemisioduye@gmail.com instead of using the issue tracker.

## Credits

- Oduye Oluwayemisi

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-travis]: https://img.shields.io/travis/andela-ooduye/PotatoORM/master.svg?style=flat-square

[link-travis]: https://travis-ci.org/andela-ooduye/PotatoORM
[link-author]: https://github.com/andela-ooduye
[link-contributors]: ../../contributors
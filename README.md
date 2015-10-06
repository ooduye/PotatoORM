# Evangelist Status

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

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

[ico-version]: https://img.shields.io/packagist/v/ooduye/evangelist-status.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/andela-ooduye/EvangelistStatus/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/thephpleague/evangeliststatus.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/thephpleague/evangeliststatus.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ooduye/evangelist-status.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ooduye/evangelist-status
[link-travis]: https://travis-ci.org/andela-ooduye/EvangelistStatus
[link-scrutinizer]: https://scrutinizer-ci.com/g/thephpleague/evangeliststatus/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/thephpleague/evangeliststatus
[link-downloads]: https://packagist.org/packages/ooduye/evangelist-status
[link-author]: https://github.com/andela-ooduye
[link-contributors]: ../../contributors
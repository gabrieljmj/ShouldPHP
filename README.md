ShouldPHP
=========

In-development.

###Quick examples of use

```php
#test.php

use Gabrieljmj\Should\Ambient;

$a = new Ambient('test');
$a->theClass('Employee')->should->be->instance('Person');
$a->theProperty('Employee', 'role')->should->be->equals('Conserje');

return $a;
```
Console:
```
php bin/should execute test.php
```

Several:
```json
//should.json
{
    "ambients": [
        "test.php",
        "test2.php",
        "test3.php",
        "othertests/"
    ]
}
```
```
php bin/should execute should.json
```

Saving logs (command ```-s|--save```):
```
php bin/should execute test.php -s "tests.log"
```

Help:
```
php bin/should help
```

```
                                                                   ____________________
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@======@@@@@@     |                    |
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@|_____/@@@@@@@ ___|                    |
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  \__    YOU SHOULD...!   |
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@/\@@@@@@/\@@@@@@      |                    |
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@                                     |____________________|
@|               /@@@@@@@@@@@
@\               /@@@@@@@@@@//
@@\             /@@@@@@@@@@@@//
@@@\          /@@@@@@@@@@@@//
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
@@@@@@@@@@@@@@@@@@@@@@----------. @
@@@@@@@@@@@@@@@@@@@@@|           \ @
@@@@@@@@@@@@@@@@@@@@@|            | @
@@@@@@@@@@@@@@@@@@@@@|___________/ @
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
```
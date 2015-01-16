ShouldPHP
=========

In-development.

```php
#test.php

use Gabrieljmj\Should\Ambient;

$a = new Ambient('test');
$a->theClass('Employee')->should->be->instance('Person');

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
        "test3.php"
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
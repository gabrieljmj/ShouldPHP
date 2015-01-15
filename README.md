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
php should execute test.php
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
php should should:execute should.json
```

Saving logs (command ```-s|--save```):
```
php should execute test.php -s "tests.log"
```
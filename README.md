ShouldPHP
=========

In-development.

```php
#test.php

use Gabrieljmj\Should\Ambient;

$a = new Ambient('test');
$a->theClass('Employee')->should->be->instance('Person');

returna $a;
```
Console:
```
php app.php should:execute test.php
```
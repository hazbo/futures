# Futures

Define: **Futures** -

"Futures (also known as "promises") are objects which act as placeholders for
some future result of computation. They let you express parallel and
asynchronous execution with a natural syntax. There are three provided
concrete Future implementations: ExecFuture for executing system commands,
HTTPFuture for making HTTP requests, and QueryFuture for executing database
queries." - *Facebook*

This is all true, however *this* library only supports http requests and the
ability to execute system commands, asynchronously (or synchronously).

### What is it?

This set of files was originaly forked from Facebook's [libphutil](https://github.com/facebook/libphutil) which has
some pretty nifty little tools, you should go check it out!

These libraries are for everything in the `src/future` so I've namespaced
them up, cleaned up the code to follow PSR standards (not finished!) and
have only tested a very small part of it; making http requests.

### Install
You can add this component to your project using composer:

```json
{
	"require" : {
		"hazbo/futures" : "dev-master"
	}
}
```

`composer install` or `php composer.phar install`

### Asynchronously

```php
<?php
require_once('path/to/vendor/autoload.php');

use Hazbo\Component\Http\HttpFuture;

$future = new HttpFuture('http://graph.facebook.com/zuck');
$future->start();

// Check to see if the request has finished
var_dump($future->isReady());

// Hang back a second
sleep(1);

// Lets check again...
var_dump($future->isReady());

// One more sec!
sleep(1);

// Should be ready now!
var_dump($future->isReady());
```

So above we can see what is going on, pretty straight forward. We can call:

  - `start()`
  - `isReady()`
  - `resolve()`

Calling `resolve` will wil block the future until it has finished processing
the request, so essentially acting synchronously. `start` will fire off the
request and you can then check the progress of this using `isReady`.

### Synchronously

```php
<?php
require_once('path/to/vendor/autoload.php');

use Hazbo\Component\Http\HttpFuture;

$future = new HttpFuture('http://graph.facebook.com/zuck');
list($body, $headers) = $future->resolvex();

echo $body;
```

So above we are just making a synchronous request, it will block until the
request has finished.

I don't know how well I've explained this... but it's awesome! Credit to the
guys at [Facebook](https://github.com/facebook) who started this off. Feel free to contribute!

### Disclaimer
I have not yet finished off the code for performing system commands! I'm working
real hard on it though.

**I need help to tidy up some of the code!**... *please help*.

# Future

Define: **Futures** :

"Futures (also known as "promises") are objects which act as placeholders for
some future result of computation. They let you express parallel and
asynchronous execution with a natural syntax. There are three provided
concrete Future implementations: ExecFuture for executing system commands,
HTTPFuture for making HTTP requests, and QueryFuture for executing database
queries." - *Facebook*

This set of files was originaly forked from Facebook's `libphutil` which has
some pretty nifty little tools, you should go check it out!

These libraries are for everything in the `src/future` so I've namespaced
them up, cleaned up the code to follow PSR standards (not finished!) and
have only tested a very small part of it; making Http Requests.

	use Hazbo\Component\Http\HttpFuture;

	$future = new HTTPFuture('http://graph.facebook.com/zuck');
	list($response_body, $headers) = $future->resolvex();

	echo $response_body;

The above works, but I've only spent a few hours with this code so
there is a lot more to do.
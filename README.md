Cure for `$presenter->redirect([$code, ], $destination[, $arguments])` in middle of events.
* You don't have to include application or presenter into listener just redirector.
* All attached listeners are executed. Assuming they don't kill app or throw exceptions.
* Guaranteed first point of possible redirection in whole system.
* Easier redirection testing.

*Assuming you use it across whole system.*


# Setup

## Install
`composer install rixxi/redirector`

## Configure
```neon
extensions:
	- Rixxi\Redirector\DI\RedirectorExtension
```

## Enable support in presenter

```php
<?php

use Rixxi\Application\UI\Presenter\EnableRedirector;


class BasePresenter extends Nette\Application\UI\Presenter
{
	use EnableRedirector;
}
```
*Defines BasePresenter::beforeRender and asks for injection of redirector.*

# Then you are free to do this

```php
<?php

class ExamplePresenter extends BasePresenter
{

	/** @var \Service @ inject */
	public $service;


	public function actionDefault()
	{
		$this->service->onError[] = function () { // redirect back on error
			$this->redirector->redirect('this'); // if you used $presenter->redirect here next events would not execute
		};
		
		$this->service->onError[] = function () { // say something to admin
			$this->reporter->say('I might be sick!');
		};
	}

}
```

*Now imagine whole ekosystem of plugins around idea of distribution and (late) delegation.*

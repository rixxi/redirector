<?php

namespace Rixxi\Redirector;

use Nette\Application\UI\Presenter;


/**
 * Despite looking like a Presenters interface it must to redirect at Presenter::beforeRender not immediately.
 * @see Rixxi\Application\UI\Presenter\Redirector
 */
interface IRedirector
{

	/** @return bool */
	public function hasRedirect();

	/** @see Presenter::redirect([$code, ]$destination[, $arguments]) */
	public function redirect($code, $destination = NULL, $args = array());

	/** @see Presenter::redirectUrl */
	public function redirectUrl($url, $code = NULL);

	public function performRedirectIfNecessary(Presenter $presenter);

}

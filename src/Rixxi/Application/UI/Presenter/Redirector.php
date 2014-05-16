<?php

namespace Rixxi\Application\UI\Presenter;


/**
 * Overrides beforeRender for redirecting via Rixxi\Redirector\IRedirector.
 */
trait EnableRedirector
{

	/**
	 * @inject
	 * @var \Rixxi\Redirector\IRedirector
	 */
	public $redirector;


	protected function beforeRender()
	{
		$this->redirector->performRedirectIfNecessary($this);
	}

}

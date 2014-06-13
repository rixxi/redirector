<?php

namespace Rixxi\Bridges\RedirectorKdybyEvents;

use Kdyby;
use Rixxi\Redirector\IRedirector;


/**
 * Template class for redirection upon events. Further plan is to make template from it for code generator with variable
 * <events> instead of inheriting this class and defining getEvents method.
 *
 * @experimental
 */
abstract class RedirectSubscriber implements Kdyby\Events\Subscriber
{

	/** @var IRedirector  */
	private $redirector;

	/** @var mixed[] */
	private $arguments;


	/**
	 * @param IRedirector
	 * @param string[]|string List of events to redirect upon
	 * @see \Rixxi\Redirector\Redirector::redirect
	 */
	public function __construct(IRedirector $redirector, $code, $destination = NULL, $arguments = array())
	{
		$this->redirector = $redirector;
		$arguments = func_get_args();
		array_shift($arguments);
		$this->arguments = $arguments;
	}


	public function getSubscribedEvents()
	{
		return array_fill_keys($this->getEvents(), 'eventHandler');
	}


	public function eventHandler()
	{
		call_user_func_array(array($this->redirector, 'redirect'), $this->arguments);
	}


	/** @return string[] */
	abstract protected function getEvents();

}

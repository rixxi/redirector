<?php

namespace Rixxi\Redirector\DI;

use Nette;


class RedirectorExtension extends Nette\DI\CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('redirector'))
			->setClass('Rixxi\\Redirector\\Redirector');
	}

}

<?php

namespace Knnf\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KnnfUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}

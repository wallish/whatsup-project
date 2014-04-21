<?php

namespace Knnf\WhatsupBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KnnfWhatsupBundle extends Bundle
{
	public function getParent()
	{
    	return 'FOSUserBundle';
	}
}

<?php
namespace APP\plugins\generic\publicationValidator\classes;

use APP\core\Request;
use APP\plugins\generic\publicationValidator\classes\services\ServiceDOAJ;
use APP\plugins\generic\publicationValidator\classes\services\ServiceOpenAire;
use Exception;

class PublicationValidatorFactory
{
    /**
     * @throws Exception
     */
    public static function createValidator(string $service, Request $request): PublicationValidator {
        return match (strtolower($service)) {
            'doaj' => new ServiceDOAJ($request),
            'openaire' => new ServiceOpenAire($request),
        };
	}
}

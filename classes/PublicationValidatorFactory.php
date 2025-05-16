<?php
namespace APP\plugins\generic\publicationValidator\classes;

use APP\plugins\generic\publicationValidator\classes\services\ServiceDOAJ;
use APP\plugins\generic\publicationValidator\classes\services\ServiceOpenAire;
use Exception;

class PublicationValidatorFactory
{
    /**
     * @throws Exception
     */
    public static function createValidator(string $service): PublicationValidator {
        return match (strtolower($service)) {
            'doaj' => new ServiceDOAJ(),
            'openAire' => new ServiceOpenAire(),
            default => throw new Exception("Unknown service: $service"),
        };
	}
}

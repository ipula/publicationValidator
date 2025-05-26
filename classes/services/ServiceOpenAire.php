<?php
namespace APP\plugins\generic\publicationValidator\classes\services;

use APP\plugins\generic\publicationValidator\classes\dto\PublicationMetadata;
use APP\plugins\generic\publicationValidator\classes\PublicationValidator;

class ServiceOpenAire extends PublicationValidator
{
	protected function validateMetadata(PublicationMetadata $metadata): void {
		$schema = $this->getValidatorSchema('DOAJ');
		$this->checkRequiredFields($metadata, $schema);
	}
}

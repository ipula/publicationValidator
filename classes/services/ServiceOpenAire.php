<?php
namespace APP\plugins\generic\publicationValidator\classes\services;

use APP\plugins\generic\publicationValidator\classes\PublicationValidator;

class ServiceOpenAire extends PublicationValidator
{
	/**
	 * @param array $metadata
	 * @return void
	 */
	protected function validateMetadata(array $metadata): void {
		$schema = $this->getValidatorSchema('DOAJ');
		$this->checkRequiredFields($metadata, $schema);
	}
}

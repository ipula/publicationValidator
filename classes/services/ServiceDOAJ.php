<?php
namespace APP\plugins\generic\publicationValidator\classes\services;

use APP\plugins\generic\publicationValidator\classes\dto\PublicationMetadata;
use APP\plugins\generic\publicationValidator\classes\PublicationValidator;

class ServiceDOAJ extends PublicationValidator
{
	protected function validateMetadata(PublicationMetadata $metadata): void {

		$schema = $this->getValidatorSchema('DOAJ');
		$jsonData = json_encode($schema);
		$requiredFields = json_decode($jsonData,TRUE);
		$this->checkRequiredFields($metadata, $requiredFields['metadata']);
		$this->supportedLocalForMetadata($metadata, $requiredFields['metadata'], $requiredFields['localizedFields']);
	}
}

<?php
import('plugins.generic.publicationValidator.classes.PublicationValidator');

class ServiceDOAJ extends PublicationValidator
{
	/**
	 * validate publication fields for DOAJ service
	 * @return void
	 */
	protected function validateMetadata(array $metadata): void {

		$schema = $this->getValidatorSchema('DOAJ');
		$jsonData = json_encode($schema);
		$requiredFields = json_decode($jsonData,TRUE);
		$this->checkRequiredFields($metadata, $requiredFields);
	}
}

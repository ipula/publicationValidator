<?php

class ServiceOpenAire extends PublicationValidator
{
	/**
	 * @param array $metadata
	 * @return void
	 */
	protected function validateMetadata(array $metadata): void {
		$schema = $this->getValidatorSchema('DOAJ');
		$jsonData = json_encode($schema);
		$requiredFields = json_decode($jsonData,TRUE);
		$this->checkRequiredFields($metadata, $requiredFields);
	}
}

<?php

abstract class PublicationValidator
{

	protected array $errors;
    private string $path = '../xmlSchema/';

	/**
	 * validate
	 */
	abstract protected function validateMetadata(array $metadata);

	/**
	 * Load service xml schemas
	 * @param string $fileName
	 * @return SimpleXMLElement
	 */
	public function getValidatorSchema(string $fileName): SimpleXMLElement {
		return simplexml_load_file($this->path . $fileName.'.xml');
	}

	/**
	 * Validate publication meta-data
	 * @param array $metadata
	 * @return bool
	 */
	public function validate(array $metadata): bool {
		$this->errors = [];
		$this->validateMetadata($metadata);
		return empty($this->errors);
	}

	protected function checkRequiredFields(array $metadata, array $requiredFields): void {
		foreach ($requiredFields as $field) {
			if ($field['value'] === ValidationTypes::REQUIRED && empty($metadata[$field])) {
				$this->errors[] = "Missing required field: '$field'";
			}
			if ($field['value'] === ValidationTypes::RECOMMENDED && empty($metadata[$field])) {
				$this->errors[] = "Recommended field is missing: '$field'";
			}
		}
	}

	/**
	 * get all validation errors
	 * @return array
	 */
	public function getErrors(): array
	{
		return $this->errors;
	}

}

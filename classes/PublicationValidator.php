<?php
namespace APP\plugins\generic\publicationValidator\classes;

abstract class PublicationValidator
{
	protected array $errors;
    private string $path = 'plugins/generic/publicationValidator/validationSchema/';

	/**
	 * validate
	 */
	abstract protected function validateMetadata(array $metadata);

	/**
	 * Load service JSON schemas
	 * @param string $fileName
	 * @return
	 */
	public function getValidatorSchema(string $fileName):array{
		$validationSchema = file_get_contents($this->path . $fileName.'.json');
		return json_decode($validationSchema, true);
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
		foreach ($requiredFields as $key =>$field) {
			if ($field === ValidationTypes::REQUIRED->value && empty($metadata[$key])) {
				$this->errors[] = "Missing required field:". $key;
			}
			if ($field === ValidationTypes::RECOMMENDED->value && empty($metadata[$key])) {
				$this->errors[] = "Recommended field is missing:". $key;
			}
		}
	}

    protected function supportedLocalForMetadata(array $metadata,array $localizedFields)
    {
//        foreach ($localizedFields as $key =>$field) {
//            if ($field === ValidationTypes::REQUIRED->value && empty($metadata[$key])) {
//                $this->errors[] = "Missing required field:". $key;
//            }
//            if ($field === ValidationTypes::RECOMMENDED->value && empty($metadata[$key])) {
//                $this->errors[] = "Recommended field is missing:". $key;
//            }
//        }
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

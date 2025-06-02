<?php

namespace APP\plugins\generic\publicationValidator\classes;

use APP\plugins\generic\publicationValidator\classes\dto\PublicationMetadata;
use PKP\validation\ValidatorFactory;

abstract class PublicationValidator
{
    public array $errors = [];
    private string $path = 'plugins/generic/publicationValidator/validationSchema/';

    /**
     * validate
     */
    abstract protected function validateMetadata(PublicationMetadata $metadata);

    /**
     * Load service JSON schema from a file
     *
     * @param string $fileName
     * @return array<string, mixed>
     * @throws \RuntimeException
     */
    public function getValidatorSchema(string $fileName): array
    {
        $file = $this->path . $fileName . '.json';

        if (!file_exists($file)) {
            throw new \RuntimeException("Schema file not found: $file");
        }

        $validationSchema = file_get_contents($file);
        $decoded = json_decode($validationSchema, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException("Invalid JSON in schema: " . json_last_error_msg());
        }

        return $decoded;
    }

    /**
     * Validate publication meta-data
     * @param PublicationMetadata $metadata
     * @return bool
     */
    public function validate(PublicationMetadata $metadata): bool
    {
        $this->errors = [];
        $this->validateMetadata($metadata);
        return empty($this->errors);
    }

    protected function checkRequiredFields(PublicationMetadata $metadata, array $rules, array $messages): void
    {
//        foreach ($requiredFields as $key => $field) {
//            if ($field === ValidationTypes::REQUIRED->value && empty($metadata->$key)) {
//                $this->errors[] = "Missing required field:" . $key;
//            }
//            if ($field === ValidationTypes::RECOMMENDED->value && empty($metadata->$key)) {
//                $this->errors[] = "Recommended field is missing:" . $key;
//            }
//        }
        $data = $metadata->toArray();
        $validate = ValidatorFactory::make(
            $data,
            $rules,
            $messages
        );
        $this->errors[] = $validate->errors()->toArray()['affiliation'][0];
    }

    /**
     * @param PublicationMetadata $metadata
     * @param array $requiredFields
     * @param array $localizedFields
     * @return void
     */
    protected function supportedLocalForMetadata(PublicationMetadata $metadata, array $requiredFields, array $localizedFields): void
    {
        foreach ($localizedFields as $key => $field) {
            foreach ($field as $lang) {
                if ($requiredFields[$key] === ValidationTypes::REQUIRED->value && empty($metadata->$key[$lang['code']])) {
                    $this->errors[] = "Missing Multilingual field:" . $key . " - " . $lang['code'];
                }
            }
        }
    }
}

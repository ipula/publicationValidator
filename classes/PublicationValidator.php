<?php

namespace APP\plugins\generic\publicationValidator\classes;

use APP\plugins\generic\publicationValidator\classes\dto\PublicationMetadata;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;
use PKP\validation\ValidatorFactory;

abstract class PublicationValidator
{
    private ?Validator $validator = null;

    /**
     * validate
     */
    abstract protected function validateMetadata(PublicationMetadata $metadata);

    /**
     * Validate publication meta-data
     * @param PublicationMetadata $metadata
     */
    public function validate(PublicationMetadata $metadata) : void
    {
        $this->validateMetadata($metadata);
    }

    protected function checkRequiredFields(PublicationMetadata $metadata, array $rules, array $messages): void
    {
        $data = $metadata->toArray();
//        dd($data);
        $this->validator = ValidatorFactory::make(
            $data,
            $rules,
            $messages
        );
    }

    public function isValid(): bool
    {
        return !$this->validator->fails();
    }

    public function getErrors(): MessageBag
    {
        return $this->validator->errors();
    }

}

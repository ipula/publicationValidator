<?php
namespace APP\plugins\generic\publicationValidator\classes\services;

use APP\plugins\generic\publicationValidator\classes\dto\PublicationMetadata;
use APP\plugins\generic\publicationValidator\classes\PublicationValidator;

class ServiceOpenAire extends PublicationValidator
{
	protected function validateMetadata(PublicationMetadata $metadata): void {
        $rules = $this->getValidationRules();
        $messages = $this->getValidationMessages();
        $this->checkRequiredFields($metadata, $rules,$messages);
    }

    /**
     * @return array[]
     */
    public function getValidationRules(): array
    {
        $validationRules = [
            'affiliation' => [
                'affiliation.required', // Make optional for all locales
                'string',
                'max:255',
            ],
        ];

        return $validationRules;
    }

    public function getValidationMessages(): array
    {
        return [
            'required' => 'affiliation required',
        ];
    }
}

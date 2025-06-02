<?php
namespace APP\plugins\generic\publicationValidator\classes\services;

use APP\plugins\generic\publicationValidator\classes\dto\PublicationMetadata;
use APP\plugins\generic\publicationValidator\classes\PublicationValidator;

class ServiceOpenAire extends PublicationValidator
{
	protected function validateMetadata(PublicationMetadata $metadata): void {
		$schema = $this->getValidatorSchema('DOAJ');
        $jsonData = json_encode($schema);
//		$requiredFields = json_decode($jsonData,TRUE);
        $this->checkRequiredFields($metadata, $this->getValidationRules(),$this->getValidationMessages());
//		$this->supportedLocalForMetadata($metadata, $requiredFields['metadata'], $requiredFields['localizedFields']);
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
            'required' => 'abstract required',
        ];
    }
}

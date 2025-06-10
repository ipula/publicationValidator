<?php
namespace APP\plugins\generic\publicationValidator\classes\services;

use APP\core\Request;
use APP\plugins\generic\publicationValidator\classes\dto\PublicationMetadata;
use APP\plugins\generic\publicationValidator\classes\PublicationValidator;

class ServiceDOAJ extends PublicationValidator
{
    private Request $request;
    public function __construct(Request $request){
        $this->request = $request;
    }
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
        $context = $this->request->getContext();
        $primaryLocale = $context->getPrimaryLocale();
        $allowedLocales = $context->getSupportedFormLocales();

        $validationRules = [
            "abstract" => [
                'required',
                'array',
            ],
            "abstract.{$primaryLocale}" => [
                'required',
                'string',
            ],
            "abstract.fr_CA" => [
                'required',
                'string',
            ],
            "title" => [
                'required',
                'array',
            ],
            "title.{$primaryLocale}" => [
                'required',
                'string',
            ],
            "locale" => [
                'required',
                'string',
                'max:255',
            ],
            "publisher" => [
                'required',
                'string',
            ],
            "printIssn" => [
                'required',
                'string',
            ],
            "onlineIssn" => [
                'required',
                'string',
            ],
            "doi" => [
                'required',
                'url',
            ],
            "licenseUrl" => [
                'required',
                'url',
            ],
            "subjects" => [
                'required',
                'array',
            ],
            "rights" => [
                'required',
                'string',
                'max:255',
            ],
            "dateSubmitted" => [
                'required',
                'string',
            ],
            "citations" => [
                'required',
                'array',
            ],
            "journalTitle" => [
                'required',
                'array',
            ],
            "journalTitle.{$primaryLocale}" => [
                'required',
                'string',
            ],
            "publisherInstitution" => [
                'required',
                'string',
            ],
        ];
//        dd($validationRules);

        return $validationRules;
    }

    public function getValidationMessages(): array
    {
        return [
            'abstract.fr_CA.required' => 'abstract fr required',
            'abstract.en.required' => 'abstract en required',
            'publisherInstitution.required' => 'doi required',
            'doi.required' => 'doi required',
            'citations.required' => 'citations required',
            'dateSubmitted.required' => 'dateSubmitted required',
            'rights.required' => 'rights required',
            'subjects.required' => 'subjects required',
            'onlineIssn.required' => 'onlineIssn required',
            'printIssn.required' => 'printIssn required',
            'publisher.required' => 'publisher required',
            'locale.required' => 'locale required',
            'title.required' => 'title required',
            'title.en.required' => 'title en required',
            'journalTitle.required' => 'journalTitle required',
            'journalTitle.en.required' => 'journalTitle en required',
            'doi.url' => 'doi is not a valid url',
        ];
    }
}

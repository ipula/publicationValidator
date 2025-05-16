<?php
namespace APP\plugins\generic\publicationValidator\classes;

use APP\submission\Submission;
use PKP\context\Context;

class PublicationValidatorResource
{
	public function transformSubmissionMetadata(Submission $submission,Context $context): array
	{
		$publication = $submission->getCurrentPublication();
		return [
			'title' => $publication->getData('title',null),
			'authors' => $publication->getData('authors'),
			'locale' => $publication->getData('locale'),
			'abstract' => $publication->getData('abstract',$publication->getData('locale')),
			'publisher' => $context->getData('publisherInstitution'),
			'printIssn' => $context->getData('printIssn'),
			'onlineIssn' => $context->getData('onlineIssn'),
			'doi' => '',
			'licenseUrl' => $publication->getData('licenseUrl'),
			'subjects' => $publication->getData('subjects'),
			'rights' => $publication->getData('rights'),
		];
	}
}

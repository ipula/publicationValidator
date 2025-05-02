<?php

class PublicationValidatorResource
{
	public function transformSubmissionMetadata(Submission $submission,Context $context): array
	{
		$publication = $submission->getCurrentPublication();
		return [
			'title' => $publication->getData('title',$publication->getData('locale')),
			'authors' => $publication->getData('authors'),
			'locale' => $publication->getData('locale'),
			'abstract' => $publication->getData('abstract',$publication->getData('locale')),
			'publisher' => $context->getData('publisherInstitution'),
			'printIssn' => $context->getData('printIssn'),
			'onlineIssn' => $context->getData('onlineIssn'),
			'doi' => $submission->getStoredPubId('doi'),
			'licenseUrl' => $publication->getData('licenseUrl'),
			'subjects' => $publication->getData('subjects'),
			'rights' => $publication->getData('rights'),
		];
	}
}

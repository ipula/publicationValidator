<?php
namespace APP\plugins\generic\publicationValidator\classes;

use APP\submission\Submission;
use PKP\context\Context;
use APP\plugins\generic\publicationValidator\classes\dto\PublicationMetadata;

final class PublicationValidatorResource
{
    public function transformSubmissionMetadata(Submission $submission, Context $context): PublicationMetadata
    {
        $publication = $submission->getCurrentPublication();

        return  new PublicationMetadata(
            title: $publication->getData('title'),
            authors: $publication->getData('authors')->toArray(),
            locale: $publication->getData('locale'),
            abstract: $publication->getData('abstract'),
            publisher: $context->getData('publisherInstitution'),
            printIssn: $context->getData('printIssn'),
            onlineIssn: $context->getData('onlineIssn'),
            doi: 'dfs',
            licenseUrl: $context->getData('licenseUrl'),
            subjects: $publication->getData('subjects'),
            rights: $publication->getData('rights'),
            dateSubmitted: $submission->getData('dateSubmitted'),
            citations: $publication->getData('citations'),
            journalTitle: $context->getData('name'),
            publisherInstitution: $context->getData('publisherInstitution'),
        );
    }
}

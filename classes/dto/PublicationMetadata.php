<?php

namespace APP\plugins\generic\publicationValidator\classes\dto;

class PublicationMetadata
{
    public function __construct(
        public ?array $title,
        public ?array $authors, // not included yet in rules
        public ?string $locale,
        public ?array $abstract,
        public ?string $publisher,
        public ?string $printIssn,
        public ?string $onlineIssn,
        public ?string $doi,
        public ?string $licenseUrl,
        public ?array $subjects,
        public ?string $rights,
        public ?string $dateSubmitted,
        public ?array $citations,
        public ?array $journalTitle,
        public ?string $publisherInstitution,
    ) {}

    /**
     * Convert the instance to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}

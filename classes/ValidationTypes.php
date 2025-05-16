<?php
namespace APP\plugins\generic\publicationValidator\classes;
enum ValidationTypes: string
{
	case REQUIRED = 'required';
	case OPTIONAL = 'optional';
	case RECOMMENDED = 'recommended';
}

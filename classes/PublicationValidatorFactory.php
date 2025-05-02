<?php

class PublicationValidatorFactory
{
	public static function createValidator(string $service): PublicationValidator {
		switch (strtolower($service)) {
			case 'doaj':
				return new ServiceDOAJ();
			case 'openAire':
				return new ServiceOpenAire();
			default:
				throw new Exception("Unknown service: $service");
		}
	}
}

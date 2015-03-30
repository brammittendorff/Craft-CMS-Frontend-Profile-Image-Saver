<?php
namespace Craft;

class AviaryFrontendPlugin extends BasePlugin
{

	public function getName()
	{
		return Craft::t('Aviary Frontend Plugin');
	}

	public function getVersion()
	{
		return '0.1';
	}

	public function getDeveloper()
	{
		return 'Bram Mittendorff';
	}

	public function getDeveloperUrl()
	{
		return 'https://github.com/brammittendorff';
	}
	
}

<?php
namespace Craft;

class AviaryFrontend_ImageController extends BaseController
{

	/**
	 * Save image with alot of security checks
	 * @return [json] [Returns a succes true or false with a reason in json]
	 */
	public function actionSaveImage()
	{
		if (!craft()->config->get('devMode')) {
			$this->requireAjaxRequest();
		}
		$this->requirePostRequest();

		$url = craft()->request->getPost('url');

		// check if url
		if (!filter_var($url, FILTER_VALIDATE_URL) === false) {

		    $size = getimagesize($url);

		    // if image is valid in php
			if (!empty($size) && !empty($size["mime"])) {
				// if user is logged in
				if (craft()->userSession->isLoggedIn()) {
					// save image
					if (craft()->aviaryFrontend_image->saveImage($url,$size["mime"])) {
						$this->returnJson(array('success' => true));
					} else {
						$this->returnJson(array(
							'success' => false,
							'reason' => 'The image could not be saved'
						));
					}
				} else {
					$this->returnJson(array(
						'success' => false,
						'reason' => 'You need to be logged in'
					));
				}
			} else {
					$this->returnJson(array(
						'success' => false,
						'reason' => 'The image is not valid in php'
					));
			}

		} else {
			$this->returnJson(array(
				'success' => false,
				'reason' => 'You did not enter a valid url'
			));
		}
		
	}

}
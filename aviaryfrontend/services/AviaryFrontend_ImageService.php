<?php
namespace Craft;

class AviaryFrontend_ImageService extends BaseApplicationComponent
{

	private $tempFile;

	private $mimeTypes = array(
		'image/gif' 	=> '.gif',
		'image/jpeg' 	=> '.jpg',
		'image/png' 	=> '.png'
	);

	/**
	 * Save the url to a image
	 * @param  [string] $url  [the image url]
	 * @param  [string] $mime [the image mimetype]
	 * @return [boolean]      [if the image succeeds or not]
	 */
    public function saveImage($url,$mime=null)
    {
    	if ($this->mimeTypes[$mime]) {

    		// add extension for filetype
    		$path = pathinfo($url);

    		$addExtension = "";
	    	if (empty($path["extension"])) {
	    		$addExtension = $this->mimeTypes[$mime];
	    	}

	    	// save image
			$tempPath = craft()->path->getTempPath();
			$this->tempFile = $tempPath.basename($url).$addExtension;
			$newImageData = file_get_contents($url);
			IOHelper::writeToFile($this->tempFile, $newImageData);

			// craft image object
			$image = craft()->images->loadImage($this->tempFile);

			$currentUser = craft()->userSession->getUser();

			craft()->users->deleteUserPhoto($currentUser);

			craft()->users->saveUserPhoto(IOHelper::getFileName($this->tempFile), $image, $currentUser);

			// cleanup tmp image
			$this->deleteTempFiles($this->tempFile);
			return true;
		}
		else {
			return false;
		}
    }

    /**
     * Deletes temp files
     * @param  [string] $fileName [A filename to delete]
     */
    private function deleteTempFiles($fileName)
    {
		IOHelper::deleteFile($fileName, true);
    }

}

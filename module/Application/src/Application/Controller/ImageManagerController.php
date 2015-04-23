<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ImageManagerController extends AbstractActionController
{
	const SIZE_ORIGINAL = 'original';
	
    public function indexAction()
    {
        $imagePath = $this->params()->fromQuery('i');
        $rendition = $this->params()->fromQuery('r', self::SIZE_ORIGINAL);

        if (!$imagePath) {
            return $this->notFoundAction();
        }

        /* @var $imageManager \ImgMan\Service\ImageService */
        $imageManager = $this->getServiceLocator()->get('ImgMan\Service\Default');

        /** @var \Matryoshka\Model\ResultSet\HydratingResultSet $imageRef */
        /*$imageRef = $imageManager->getImageRefCollection()->get($imagePath, $rendition)->current();

        if (!$imageRef) {
            return $this->notFoundAction();
        }*/

        //if ($imageRef->storage == ImageManager::STORAGE_LOCAL) {
            //$image = $imageManager->getLocalStorage()->loadImage($imageRef->imageId);
            $image = $imageManager->get($imagePath, $rendition);
            if ($image === null) {
                return $this->notFoundAction();
            }

            header("Content-Type: image/jpeg");
            header("Content-Size: " . strlen($image->getBlob()));

            echo $image->getBlob();

            exit;
        //}

        return $this->notFoundAction();
    }

    public function notFoundAction()
    {
        $default = $this->params()->fromQuery('d', null);

        if (!$default || $default[0] != '/') {
            $default = $this->getServiceLocator()->get('Config')['cdn']['local']['placeholder_url'];
        }

        return $this->redirect()->toUrl($default);
    }	
}


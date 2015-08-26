<?php
/**
 * Created by PhpStorm.
 * User: kuzin
 * Date: 27.07.15
 * Time: 8:19
 */

namespace Hackathon\Model;


class SizerImage
{

    const NO_PHOTO = 'no-image.png';

    const FULL_URL_PHOTO_PROJECT = '/home/kuzin/sites/hackathon/public/img/projectimages/';
    const LOCAL_URL_PHOTO_PROJECT = '/img/projectimages/';
    const FULL_URL_PHOTO_UPLOADS = '/home/kuzin/sites/hackathon/public/img/uploads/';
    const LOCAL_URL_PHOTO_UPLOADS = '/img/uploads/';

    public $passImage;
    public $nameImage;
    public $width;
    public $height;

    public function __construct($allPassUrl,$nameImage)
    {
        $this->passImage = $allPassUrl;
        $this->nameImage = $nameImage;
    }

    public function sizeWidthHeight($maxWidth, $maxHeight)
    {
        if (!file_exists($this->passImage . $this->nameImage)) $this->nameImage = self::NO_PHOTO;
        if (filesize($this->passImage . $this->nameImage) != 0)
        {
            list($width, $height) = getimagesize($this->passImage . $this->nameImage);

            if ($width != 0 && $height != 0)
            {
                $ratioWidth = $maxWidth / $width;
                $ratioHeight = $maxHeight / $height;

                $ratio = min($ratioHeight, $ratioWidth);

                $widthImage = intval($ratio * $width);
                $heightImage = intval($ratio * $height);

            } else {
                $widthImage = '';
                $heightImage = '';
            }
            $this->height = $heightImage;
            $this->width = $widthImage;

            return ' width="' . $widthImage . ' "height="' . $heightImage . '"';
        }
        return '';
    }

    public function getWidht()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

}
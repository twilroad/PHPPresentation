<?php

namespace TwilRoad\PhpPresentation\Writer\ODPresentation;

use TwilRoad\Common\Adapter\Zip\ZipInterface;
use TwilRoad\PhpPresentation\Shape\Drawing;
use TwilRoad\PhpPresentation\Slide\Background\Image;

class Pictures extends AbstractDecoratorWriter
{
    /**
     * @return ZipInterface
     * @throws \Exception
     */

    public function render()
    {
        $arrMedia = array();
        for ($i = 0; $i < $this->getDrawingHashTable()->count(); ++$i) {
            $shape = $this->getDrawingHashTable()->getByIndex($i);
            if (!($shape instanceof Drawing\AbstractDrawingAdapter)) {
                continue;
            }
            $arrMedia[] = $shape->getIndexedFilename();
            $this->getZip()->addFromString('Pictures/' . $shape->getIndexedFilename(), $shape->getContents());
        }

        foreach ($this->getPresentation()->getAllSlides() as $keySlide => $oSlide) {
            // Add background image slide
            $oBkgImage = $oSlide->getBackground();
            if ($oBkgImage instanceof Image) {
                $this->getZip()->addFromString('Pictures/'.$oBkgImage->getIndexedFilename($keySlide), file_get_contents($oBkgImage->getPath()));
            }
        }
        
        return $this->getZip();
    }
}

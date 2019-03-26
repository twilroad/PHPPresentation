<?php

namespace TwilRoad\PhpPresentation\Writer\PowerPoint2007;

use TwilRoad\PhpPresentation\Shape\Drawing\AbstractDrawingAdapter;

class PptMedia extends AbstractDecoratorWriter
{
    /**
     * @return \TwilRoad\Common\Adapter\Zip\ZipInterface
     * @throws \Exception
     */
    public function render()
    {
        for ($i = 0; $i < $this->getDrawingHashTable()->count(); ++$i) {
            $shape = $this->getDrawingHashTable()->getByIndex($i);
            if (!$shape instanceof AbstractDrawingAdapter) {
                continue;
            }
            $this->getZip()->addFromString('ppt/media/' . $shape->getIndexedFilename(), $shape->getContents());
        }

        return $this->getZip();
    }
}

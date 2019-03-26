<?php

namespace TwilRoad\PhpPresentation\Writer\ODPresentation;

class Mimetype extends AbstractDecoratorWriter
{
    /**
     * @return \TwilRoad\Common\Adapter\Zip\ZipInterface
     * @throws \Exception
     */
    public function render()
    {
        $this->getZip()->addFromString('mimetype', 'application/vnd.oasis.opendocument.presentation');
        return $this->getZip();
    }
}

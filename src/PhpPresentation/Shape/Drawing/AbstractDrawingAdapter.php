<?php

namespace TwilRoad\PhpPresentation\Shape\Drawing;

use TwilRoad\PhpPresentation\Shape\AbstractGraphic;

abstract class AbstractDrawingAdapter extends AbstractGraphic
{
    /**
     * @return string
     */
    abstract public function getContents();

    /**
     * @return string
     */
    abstract public function getExtension();

    /**
     * @return string
     */
    abstract public function getIndexedFilename();

    /**
     * @return string
     */
    abstract public function getMimeType();
}

<?php

namespace TwilRoad\PhpPresentation\Shape;

use TwilRoad\PhpPresentation\AbstractShape;
use TwilRoad\PhpPresentation\ComparableInterface;

/**
 * Class Geometry
 * @package TwilRoad\PhpPresentation\Shape
 */
class Geometry extends AbstractShape implements ComparableInterface
{

    protected $pathString;

    public function setPathString($pathString)
    {
        $this->pathString = $pathString;
    }
}

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

    /**
     * @var string
     */
    protected $pathString;

    /**
     * @return string
     */
    public function getPathString()
    {
        return $this->pathString;
    }

    /**
     * @param string $pathString
     */
    public function setPathString($pathString = '')
    {
        $this->pathString = $pathString;
    }
}

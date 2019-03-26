<?php

namespace TwilRoad\PhpPresentation\Shape\Chart;

use TwilRoad\PhpPresentation\Style\Outline;

class Gridlines
{
    /**
     * @var Outline
     */
    protected $outline;

    public function __construct()
    {
        $this->outline = new Outline();
    }

    /**
     * @return Outline
     */
    public function getOutline()
    {
        return $this->outline;
    }

    /**
     * @param Outline $outline
     * @return Gridlines
     */
    public function setOutline(Outline $outline)
    {
        $this->outline = $outline;
        return $this;
    }
}

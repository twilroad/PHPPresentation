<?php

namespace TwilRoad\PhpPresentation\Writer\ODPresentation;

use TwilRoad\PhpPresentation\Shape\Chart;

abstract class AbstractDecoratorWriter extends \TwilRoad\PhpPresentation\Writer\AbstractDecoratorWriter
{
    /**
     * @var Chart[]
     */
    protected $arrayChart;

    /**
     * @return \TwilRoad\PhpPresentation\Shape\Chart[]
     */
    public function getArrayChart()
    {
        return $this->arrayChart;
    }

    /**
     * @param \TwilRoad\PhpPresentation\Shape\Chart[] $arrayChart
     * @return AbstractDecoratorWriter
     */
    public function setArrayChart($arrayChart)
    {
        $this->arrayChart = $arrayChart;
        return $this;
    }
}

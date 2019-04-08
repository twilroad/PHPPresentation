<?php
/**
 * This file is part of PHPPresentation - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPPresentation is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/TwilRoad/PHPPresentation/contributors.
 *
 * @link        https://github.com/TwilRoad/PHPPresentation
 * @copyright   2009-2015 PHPPresentation contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace TwilRoad\PhpPresentation\Shape;

use TwilRoad\PhpPresentation\ComparableInterface;
use TwilRoad\PhpPresentation\Shape\Chart\Legend;
use TwilRoad\PhpPresentation\Shape\Chart\PlotArea;
use TwilRoad\PhpPresentation\Shape\Chart\Title;
use TwilRoad\PhpPresentation\Shape\Chart\View3D;

/**
 * Chart element
 */
class Chart extends AbstractGraphic implements ComparableInterface
{

    /**
     * Title
     *
     * @var \TwilRoad\PhpPresentation\Shape\Chart\Title
     */
    private $title;

    /**
     * Legend
     *
     * @var \TwilRoad\PhpPresentation\Shape\Chart\Legend
     */
    private $legend;

    /**
     * Plot area
     *
     * @var \TwilRoad\PhpPresentation\Shape\Chart\PlotArea
     */
    private $plotArea;

    /**
     * View 3D
     *
     * @var \TwilRoad\PhpPresentation\Shape\Chart\View3D
     */
    private $view3D;

    /**
     * Include spreadsheet for editing data? Requires PHPExcel in the same folder as PhpPresentation
     *
     * @var bool
     */
    private $includeSpreadsheet = false;

    /**
     * Create a new Chart
     */
    public function __construct()
    {
        // Initialize
        $this->title = new Title();
        $this->legend = new Legend();
        $this->plotArea = new PlotArea();
        $this->view3D = new View3D();

        // Initialize parent
        parent::__construct();
    }

    public function __clone()
    {
        parent::__clone();

        $this->title = clone $this->title;
        $this->legend = clone $this->legend;
        $this->plotArea = clone $this->plotArea;
        $this->view3D = clone $this->view3D;
    }

    /**
     * Get Title
     *
     * @return \TwilRoad\PhpPresentation\Shape\Chart\Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get Legend
     *
     * @return \TwilRoad\PhpPresentation\Shape\Chart\Legend
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * Get PlotArea
     *
     * @return \TwilRoad\PhpPresentation\Shape\Chart\PlotArea
     */
    public function getPlotArea()
    {
        return $this->plotArea;
    }

    /**
     * Get View3D
     *
     * @return \TwilRoad\PhpPresentation\Shape\Chart\View3D
     */
    public function getView3D()
    {
        return $this->view3D;
    }

    /**
     * Include spreadsheet for editing data? Requires PHPExcel in the same folder as PhpPresentation
     *
     * @return boolean
     */
    public function hasIncludedSpreadsheet()
    {
        return $this->includeSpreadsheet;
    }

    /**
     * Include spreadsheet for editing data? Requires PHPExcel in the same folder as PhpPresentation
     *
     * @param  boolean $value
     *
     * @return \TwilRoad\PhpPresentation\Shape\Chart
     */
    public function setIncludeSpreadsheet($value = false)
    {
        $this->includeSpreadsheet = $value;

        return $this;
    }

    /**
     * Get indexed filename (using image index)
     *
     * @return string
     */
    public function getIndexedFilename()
    {
        return 'chart' . $this->getImageIndex() . '.xml';
    }

    /**
     * Get hash code
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        return md5(parent::getHashCode() . $this->title->getHashCode() . $this->legend->getHashCode() . $this->plotArea->getHashCode() . $this->view3D->getHashCode() . ($this->includeSpreadsheet ? 1 : 0) . __CLASS__);
    }
}

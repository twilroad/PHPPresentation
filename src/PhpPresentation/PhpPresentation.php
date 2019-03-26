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

namespace TwilRoad\PhpPresentation;

use TwilRoad\PhpPresentation\Slide;
use TwilRoad\PhpPresentation\Slide\Iterator;
use TwilRoad\PhpPresentation\Slide\SlideMaster;

/**
 * PhpPresentation
 */
class PhpPresentation
{
    /**
     * Document properties
     *
     * @var \TwilRoad\PhpPresentation\DocumentProperties
     */
    protected $documentProperties;

    /**
     * Presentation properties
     *
     * @var \TwilRoad\PhpPresentation\PresentationProperties
     */
    protected $presentationProps;

    /**
     * Document layout
     *
     * @var \TwilRoad\PhpPresentation\DocumentLayout
     */
    protected $layout;

    /**
     * Collection of Slide objects
     *
     * @var \TwilRoad\PhpPresentation\Slide[]
     */
    protected $slideCollection = array();

    /**
     * Active slide index
     *
     * @var int
     */
    protected $activeSlideIndex = 0;

    /**
     * Collection of Master Slides
     * @var \ArrayObject|\TwilRoad\PhpPresentation\Slide\SlideMaster[]
     */
    protected $slideMasters;

    /**
     * Create a new PhpPresentation with one Slide
     */
    public function __construct()
    {
        // Set empty Master & SlideLayout
        $this->createMasterSlide()->createSlideLayout();

        // Initialise slide collection and add one slide
        $this->createSlide();
        $this->setActiveSlideIndex();

        // Set initial document properties & layout
        $this->setDocumentProperties(new DocumentProperties());
        $this->setPresentationProperties(new PresentationProperties());
        $this->setLayout(new DocumentLayout());
    }

    /**
     * Get properties
     *
     * @return \TwilRoad\PhpPresentation\DocumentProperties
     * @deprecated for getDocumentProperties
     */
    public function getProperties()
    {
        return $this->getDocumentProperties();
    }

    /**
     * Set properties
     *
     * @param  \TwilRoad\PhpPresentation\DocumentProperties $value
     * @deprecated for setDocumentProperties
     * @return PhpPresentation
     */
    public function setProperties(DocumentProperties $value)
    {
        return $this->setDocumentProperties($value);
    }

    /**
     * Get properties
     *
     * @return \TwilRoad\PhpPresentation\DocumentProperties
     */
    public function getDocumentProperties()
    {
        return $this->documentProperties;
    }

    /**
     * Set properties
     *
     * @param  \TwilRoad\PhpPresentation\DocumentProperties $value
     * @return PhpPresentation
     */
    public function setDocumentProperties(DocumentProperties $value)
    {
        $this->documentProperties = $value;

        return $this;
    }

    /**
     * Get presentation properties
     *
     * @return \TwilRoad\PhpPresentation\PresentationProperties
     */
    public function getPresentationProperties()
    {
        return $this->presentationProps;
    }

    /**
     * Set presentation properties
     *
     * @param  \TwilRoad\PhpPresentation\PresentationProperties $value
     * @return PhpPresentation
     */
    public function setPresentationProperties(PresentationProperties $value)
    {
        $this->presentationProps = $value;
        return $this;
    }

    /**
     * Get layout
     *
     * @return \TwilRoad\PhpPresentation\DocumentLayout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set layout
     *
     * @param  \TwilRoad\PhpPresentation\DocumentLayout $value
     * @return PhpPresentation
     */
    public function setLayout(DocumentLayout $value)
    {
        $this->layout = $value;

        return $this;
    }

    /**
     * Get active slide
     *
     * @return \TwilRoad\PhpPresentation\Slide
     */
    public function getActiveSlide()
    {
        return $this->slideCollection[$this->activeSlideIndex];
    }

    /**
     * Create slide and add it to this presentation
     *
     * @return \TwilRoad\PhpPresentation\Slide
     * @throws \Exception
     */
    public function createSlide()
    {
        $newSlide = new Slide($this);
        $this->addSlide($newSlide);
        return $newSlide;
    }

    /**
     * Add slide
     *
     * @param  \TwilRoad\PhpPresentation\Slide $slide
     * @throws \Exception
     * @return \TwilRoad\PhpPresentation\Slide
     */
    public function addSlide(Slide $slide = null)
    {
        $this->slideCollection[] = $slide;

        return $slide;
    }

    /**
     * Remove slide by index
     *
     * @param  int $index Slide index
     * @throws \Exception
     * @return PhpPresentation
     */
    public function removeSlideByIndex($index = 0)
    {
        if ($index > count($this->slideCollection) - 1) {
            throw new \Exception("Slide index is out of bounds.");
        }
        array_splice($this->slideCollection, $index, 1);

        return $this;
    }

    /**
     * Get slide by index
     *
     * @param  int $index Slide index
     * @return \TwilRoad\PhpPresentation\Slide
     * @throws \Exception
     */
    public function getSlide($index = 0)
    {
        if ($index > count($this->slideCollection) - 1) {
            throw new \Exception("Slide index is out of bounds.");
        }
        return $this->slideCollection[$index];
    }

    /**
     * Get all slides
     *
     * @return \TwilRoad\PhpPresentation\Slide[]
     */
    public function getAllSlides()
    {
        return $this->slideCollection;
    }

    /**
     * Get index for slide
     *
     * @param  \TwilRoad\PhpPresentation\Slide\AbstractSlide $slide
     * @return int
     * @throws \Exception
     */
    public function getIndex(Slide\AbstractSlide $slide)
    {
        $index = null;
        foreach ($this->slideCollection as $key => $value) {
            if ($value->getHashCode() == $slide->getHashCode()) {
                $index = $key;
                break;
            }
        }
        return $index;
    }

    /**
     * Get slide count
     *
     * @return int
     */
    public function getSlideCount()
    {
        return count($this->slideCollection);
    }

    /**
     * Get active slide index
     *
     * @return int Active slide index
     */
    public function getActiveSlideIndex()
    {
        return $this->activeSlideIndex;
    }

    /**
     * Set active slide index
     *
     * @param  int $index Active slide index
     * @throws \Exception
     * @return \TwilRoad\PhpPresentation\Slide
     */
    public function setActiveSlideIndex($index = 0)
    {
        if ($index > count($this->slideCollection) - 1) {
            throw new \Exception("Active slide index is out of bounds.");
        }
        $this->activeSlideIndex = $index;

        return $this->getActiveSlide();
    }

    /**
     * Add external slide
     *
     * @param  \TwilRoad\PhpPresentation\Slide $slide External slide to add
     * @throws \Exception
     * @return \TwilRoad\PhpPresentation\Slide
     */
    public function addExternalSlide(Slide $slide)
    {
        $slide->rebindParent($this);

        $this->addMasterSlide($slide->getSlideLayout()->getSlideMaster());

        return $this->addSlide($slide);
    }

    /**
     * Get slide iterator
     *
     * @return \TwilRoad\PhpPresentation\Slide\Iterator
     */
    public function getSlideIterator()
    {
        return new Iterator($this);
    }

    /**
     * Create a masterslide and add it to this presentation
     *
     * @return \TwilRoad\PhpPresentation\Slide\SlideMaster
     * @throws \Exception
     */
    public function createMasterSlide()
    {
        $newMasterSlide = new SlideMaster($this);
        $this->addMasterSlide($newMasterSlide);
        return $newMasterSlide;
    }

    /**
     * Add masterslide
     *
     * @param  \TwilRoad\PhpPresentation\Slide\SlideMaster $slide
     * @return \TwilRoad\PhpPresentation\Slide\SlideMaster
     * @throws \Exception
     */
    public function addMasterSlide(SlideMaster $slide = null)
    {
        $this->slideMasters[] = $slide;

        return $slide;
    }

    /**
     * Copy presentation (!= clone!)
     *
     * @return PhpPresentation
     * @throws \Exception
     */
    public function copy()
    {
        $copied = clone $this;

        $slideCount = count($this->slideCollection);
        for ($i = 0; $i < $slideCount; ++$i) {
            $this->slideCollection[$i] = $this->slideCollection[$i]->copy();
            $this->slideCollection[$i]->rebindParent($this);
        }

        return $copied;
    }

    /**
     * Mark a document as final
     * @param bool $state
     * @return PresentationProperties
     * @deprecated for getPresentationProperties()->markAsFinal()
     */
    public function markAsFinal($state = true)
    {
        return $this->getPresentationProperties()->markAsFinal($state);
    }

    /**
     * Return if this document is marked as final
     * @return bool
     * @deprecated for getPresentationProperties()->isMarkedAsFinal()
     */
    public function isMarkedAsFinal()
    {
        return $this->getPresentationProperties()->isMarkedAsFinal();
    }

    /**
     * Set the zoom of the document (in percentage)
     * @param float $zoom
     * @return PresentationProperties
     * @deprecated for getPresentationProperties()->setZoom()
     */
    public function setZoom($zoom = 1.0)
    {
        return $this->getPresentationProperties()->setZoom($zoom);
    }

    /**
     * Return the zoom (in percentage)
     * @return float
     * @deprecated for getPresentationProperties()->getZoom()
     */
    public function getZoom()
    {
        return $this->getPresentationProperties()->getZoom();
    }

    /**
     * @return \ArrayObject|Slide\SlideMaster[]
     */
    public function getAllMasterSlides()
    {
        return $this->slideMasters;
    }

    /**
     * @param \ArrayObject|Slide\SlideMaster[] $slideMasters
     * @return $this
     */
    public function setAllMasterSlides($slideMasters = array())
    {
        if ($slideMasters instanceof \ArrayObject || is_array($slideMasters)) {
            $this->slideMasters = $slideMasters;
        }
        return $this;
    }
}

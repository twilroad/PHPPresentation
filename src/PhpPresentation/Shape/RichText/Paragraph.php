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

namespace TwilRoad\PhpPresentation\Shape\RichText;

use TwilRoad\PhpPresentation\ComparableInterface;
use TwilRoad\PhpPresentation\Style\Alignment;
use TwilRoad\PhpPresentation\Style\Bullet;
use TwilRoad\PhpPresentation\Style\Font;

/**
 * \TwilRoad\PhpPresentation\Shape\RichText\Paragraph
 */
class Paragraph implements ComparableInterface
{
    /**
     * Rich text elements
     *
     * @var \TwilRoad\PhpPresentation\Shape\RichText\TextElementInterface[]
     */
    private $richTextElements;

    /**
     * Alignment
     *
     * @var \TwilRoad\PhpPresentation\Style\Alignment
     */
    private $alignment;

    /**
     * Font
     *
     * @var \TwilRoad\PhpPresentation\Style\Font
     */
    private $font;

    /**
     * Bullet style
     *
     * @var \TwilRoad\PhpPresentation\Style\Bullet
     */
    private $bulletStyle;

    /**
     * @var integer
     */
    private $lineSpacing = 100;

    /**
     * Hash index
     *
     * @var string
     */
    private $hashIndex;

    /**
     * Create a new \TwilRoad\PhpPresentation\Shape\RichText\Paragraph instance
     */
    public function __construct()
    {
        // Initialise variables
        $this->richTextElements = array();
        $this->alignment = new Alignment();
        $this->font = new Font();
        $this->bulletStyle = new Bullet();
    }

    /**
     * Get alignment
     *
     * @return \TwilRoad\PhpPresentation\Style\Alignment
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * Set alignment
     *
     * @param  \TwilRoad\PhpPresentation\Style\Alignment $alignment
     * @return \TwilRoad\PhpPresentation\Shape\RichText\Paragraph
     */
    public function setAlignment(Alignment $alignment)
    {
        $this->alignment = $alignment;

        return $this;
    }

    /**
     * Get font
     *
     * @return \TwilRoad\PhpPresentation\Style\Font
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Set font
     *
     * @param  \TwilRoad\PhpPresentation\Style\Font $pFont Font
     * @throws \Exception
     * @return \TwilRoad\PhpPresentation\Shape\RichText\Paragraph
     */
    public function setFont(Font $pFont = null)
    {
        $this->font = $pFont;

        return $this;
    }

    /**
     * Get bullet style
     *
     * @return \TwilRoad\PhpPresentation\Style\Bullet
     */
    public function getBulletStyle()
    {
        return $this->bulletStyle;
    }

    /**
     * Set bullet style
     *
     * @param  \TwilRoad\PhpPresentation\Style\Bullet $style
     * @throws \Exception
     * @return \TwilRoad\PhpPresentation\Shape\RichText\Paragraph
     */
    public function setBulletStyle(Bullet $style = null)
    {
        $this->bulletStyle = $style;

        return $this;
    }

    /**
     * Create text (can not be formatted !)
     *
     * @param  string $pText Text
     * @return \TwilRoad\PhpPresentation\Shape\RichText\TextElement
     * @throws \Exception
     */
    public function createText($pText = '')
    {
        $objText = new TextElement($pText);
        $this->addText($objText);

        return $objText;
    }

    /**
     * Add text
     *
     * @param  \TwilRoad\PhpPresentation\Shape\RichText\TextElementInterface $pText Rich text element
     * @throws \Exception
     * @return \TwilRoad\PhpPresentation\Shape\RichText\Paragraph
     */
    public function addText(TextElementInterface $pText = null)
    {
        $this->richTextElements[] = $pText;

        return $this;
    }

    /**
     * Create break
     *
     * @return \TwilRoad\PhpPresentation\Shape\RichText\BreakElement
     * @throws \Exception
     */
    public function createBreak()
    {
        $objText = new BreakElement();
        $this->addText($objText);

        return $objText;
    }

    /**
     * Create text run (can be formatted)
     *
     * @param  string $pText Text
     * @return \TwilRoad\PhpPresentation\Shape\RichText\Run
     * @throws \Exception
     */
    public function createTextRun($pText = '')
    {
        $objText = new Run($pText);
        $objText->setFont(clone $this->font);
        $this->addText($objText);

        return $objText;
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getPlainText();
    }

    /**
     * Get plain text
     *
     * @return string
     */
    public function getPlainText()
    {
        // Return value
        $returnValue = '';

        // Loop trough all \TwilRoad\PhpPresentation\Shape\RichText\TextElementInterface
        foreach ($this->richTextElements as $text) {
            if ($text instanceof TextElementInterface) {
                $returnValue .= $text->getText();
            }
        }

        // Return
        return $returnValue;
    }

    /**
     * Get Rich Text elements
     *
     * @return \TwilRoad\PhpPresentation\Shape\RichText\TextElementInterface[]
     */
    public function getRichTextElements()
    {
        return $this->richTextElements;
    }

    /**
     * Set Rich Text elements
     *
     * @param  \TwilRoad\PhpPresentation\Shape\RichText\TextElementInterface[] $pElements Array of elements
     * @throws \Exception
     * @return \TwilRoad\PhpPresentation\Shape\RichText\Paragraph
     */
    public function setRichTextElements($pElements = null)
    {
        if (!is_array($pElements)) {
            throw new \Exception("Invalid \TwilRoad\PhpPresentation\Shape\RichText\TextElementInterface[] array passed.");
        }
        $this->richTextElements = $pElements;
        return $this;
    }

    /**
     * Get hash code
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        $hashElements = '';
        foreach ($this->richTextElements as $element) {
            $hashElements .= $element->getHashCode();
        }

        return md5($hashElements . $this->font->getHashCode() . __CLASS__);
    }

    /**
     * Get hash index
     *
     * Note that this index may vary during script execution! Only reliable moment is
     * while doing a write of a workbook and when changes are not allowed.
     *
     * @return string Hash index
     */
    public function getHashIndex()
    {
        return $this->hashIndex;
    }

    /**
     * Set hash index
     *
     * Note that this index may vary during script execution! Only reliable moment is
     * while doing a write of a workbook and when changes are not allowed.
     *
     * @param string $value Hash index
     */
    public function setHashIndex($value)
    {
        $this->hashIndex = $value;
    }

    /**
     * @return int
     */
    public function getLineSpacing()
    {
        return $this->lineSpacing;
    }

    /**
     * @param int $lineSpacing
     * @return Paragraph
     */
    public function setLineSpacing($lineSpacing)
    {
        $this->lineSpacing = $lineSpacing;
        return $this;
    }
}

<?php
/*
 * This file is part of the sfImageTransform package.
 * (c) 2007 Stuart Lowes <stuart.lowes@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * sfImageCropGD class.
 *
 * Crops image.
 *
 * This class crops a image to a set size.
 *
 * @package sfImageTransform
 * @author Stuart Lowes <stuart.lowes@gmail.com>
 * @version SVN: $Id$
 */
class sfImageCropGD extends sfImageTransformAbstract
{
  /**
   * Left coordinate.
  */
  protected $left = 0;

  /**
   * Top coordinate
  */
  protected $top = 0;

  /**
   * Cropped area width.
  */
  protected $width;

  /**
   * Cropped area height
  */
  protected $height;

  /**
   * Construct an sfImageCrop object.
   *
   * @param integer
   * @param integer
   * @param integer
   * @param integer
   */
  public function __construct($left, $top, $width, $height)
  {
    $this->setLeft($left);
    $this->setTop($top);
    $this->setWidth($width);
    $this->setHeight($height);
  }

  /**
   * Sets the left coordinate
   *
   * @param integer
   */
  public function setLeft($left)
  {
    if (is_numeric($left))
    {
      $this->left = (int)$left;

      return true;
    }

    return false;
  }

  /**
   * set the top coordinate.
   *
   * @param integer
   */
  public function setTop($top)
  {
    if (is_numeric($top))
    {
      $this->top = (int)$top;

      return true;
    }

    return false;
  }

  /**
   * set the width.
   *
   * @param integer
   */
  public function setWidth($width)
  {
    if (is_numeric($width))
    {
      $this->width = (int)$width;

      return true;
    }

    return false;
  }

  /**
   * set the height.
   *
   * @param integer
   */
  public function setHeight($height)
  {
    if (is_numeric($height))
    {
      $this->height = (int)$height;

      return true;
    }

    return false;
  }

  /**
   * Apply the transform to the sfImage object.
   *
   * @access protected
   * @param sfImage
   * @return sfImage
   */
  protected function transform(sfImage $image)
  {

    $resource = $image->getAdapter()->getHolder();
    $dest_resource = $image->getAdapter()->getTransparentImage($this->width, $this->height);

    imagecopy($dest_resource, $resource, 0, 0, $this->left, $this->top, $this->width, $this->height);

    // Tidy up
    imagedestroy($resource);

    // Replace old image with flipped version
    $image->getAdapter()->setHolder($dest_resource);

    return $image;
  }
}

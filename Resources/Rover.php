<?php

namespace Resources;

use Resources\Field;

class Rover
{
    private int $coordinateX;
    private int $coordinateY;
    private string $orientation;
    private string $orientations = 'NESW';

    function __construct($coordinateX, $coordinateY, $orientation)
    {
        $this->setCoordinateX($coordinateX);
        $this->setCoordinateY($coordinateY);
        $this->setOrientation($orientation);
    }

    /**
     * Get the value of coordinateX
     */
    public function getCoordinateX()
    {
        return $this->coordinateX;
    }

    /**
     * Set the value of coordinateX
     *
     * @return  self
     */
    public function setCoordinateX($coordinateX)
    {
        $this->coordinateX = $coordinateX;

        return $this;
    }

    /**
     * Get the value of coordinateY
     */
    public function getCoordinateY()
    {
        return $this->coordinateY;
    }

    /**
     * Set the value of coordinateY
     *
     * @return  self
     */
    public function setCoordinateY($coordinateY)
    {
        $this->coordinateY = $coordinateY;

        return $this;
    }

    /**
     * Get the value of orientation
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Set the value of orientation
     *
     * @return  self
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function operate($ordenes)
    {

        foreach ($ordenes as $orden) {
            switch ($orden) {
                case 'L':
                    $this->gear(false);
                case 'R':
                    $this->gear();
                case 'A':
                    $this->move();
            }
        }
    }

    public function gear($clockwise = true)
    {
        $orientation = $this->getOrientation();
        $position = strpos($this->orientations, $orientation);
        $this->setOrientation($this->orientations[($position + ($clockwise ? 1 : -1)) % 4]);
    }

    public function move(Field $field)
    {
        $orientation = $this->getOrientation();
        switch ($orientation) {
            case 'N':
                $this->setCoordinateY($this->getCoordinateY() + 1);
                break;
            case 'E':
                $this->setCoordinateX($this->getCoordinateX() + 1);
                break;
            case 'S':
                $this->setCoordinateY($this->getCoordinateY() - 1);
                break;
            case 'W':
                $this->setCoordinateX($this->getCoordinateX() - 1);
                break;
        }
        $this->check($field);
    }

    public function check(Field $field)
    {
        if (
            $this->getCoordinateY() > $field->getHeight() |
            $this->getCoordinateX() > $field->getWidth() |
            $this->getCoordinateY() < 0 |
            $this->getCoordinateX() < 0
        ) {
            return false;
        } else {
            return true;
        }
    }
}

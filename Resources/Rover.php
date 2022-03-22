<?php

namespace Resources;

use Resources\Field;

class Rover
{
    private int $coordinateX;
    private int $coordinateY;
    private string $orientation;
    public static $orientations = 'NESW';

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

    /**
     * Procesa las órdenes del Rover
     *
     * @return boolean false si se perdió la comunicación con el rover, true si se mantiene.
     */
    public function order($ordenes, Field $field)
    {

        foreach (str_split($ordenes) as $orden) {
            switch ($orden) {
                case 'L':
                    $this->gear(false);
                    break;
                case 'R':
                    $this->gear();
                    break;
                case 'A':
                    if ($this->move($field) == false) {
                        return false;
                    };
                    break;
            }
        }
        return true;
    }

    /**
     * Gira el Rover en sentido de las agujas del reloj o en sentido contrario.
     *
     * @return void
     */
    public function gear($clockwise = true)
    {
        $position = strpos(self::$orientations, $this->getOrientation());
        $this->setOrientation(self::$orientations[(4 + $position + ($clockwise ? 1 : -1)) % 4]);
    }

    /**
     * Mueve el Rover en el terreno
     * 
     * @return boolean false si se perdió la comunicación con el rover, true si se mantiene.
     */
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
        return $this->check($field);
    }

    /**
     * Comprueba si se perdió la comunicación con el Rover en el terreno
     * 
     * @return boolean false si se perdió la comunicación con el rover, true si se mantiene.
     */
    public function check(Field $field)
    {
        if (
            $this->getCoordinateY() >= $field->getHeight() |
            $this->getCoordinateX() >= $field->getWidth() |
            $this->getCoordinateY() < 0 |
            $this->getCoordinateX() < 0
        ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Dibuja el Rover según su orientación
     * 
     * @return void
     */
    public function draw() {
        echo '<td class="rover">';
        switch ($this->getOrientation()) {
            case 'N':
                echo '&#8593;';
                break;
            case 'E':
                echo '&#8594;';
                break;
            case 'S':
                echo '&#8595;';
                break;
            case 'W':
                echo '&#8592;';
                break;
        }
        echo '</td>';
    }    

    
    

}

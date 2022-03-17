<?php
namespace Resources;
use Resources\Rover;

class Field
{
    private int $width;
    private int $height;

    function __construct($width, $height) {
        $this->setWidth($width);
        $this->setHeight($height);
    }

    /**
     * Get the value of width
     */ 
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the value of width
     *
     * @return  self
     */ 
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the value of height
     */ 
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */ 
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Dibuja el terreno y al Rover en él según su posición y orientación
     */
    public function draw(Rover $rover) {
        echo '<table class="table-bordered">';
        for($y = $this->height-1; $y >= 0 ; $y--) {
            echo '<tr>';
            for ($x = 0; $x < $this->width ; $x++) {
                if ($rover->getCoordinateY() == $y && $rover->getCoordinateX() == $x) {
                    $rover->draw();
                }
                else echo '<td></td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

}

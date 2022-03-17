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

    public function draw(Rover $rover) {
        echo '<table class="table-bordered">';
        for($y = $this->height -1; $y < 0 ; $y--) {
            echo '<tr>';
            for ($x = $this->width -1; $x < 0 ; $x--) {
                echo '<td>';
                if ($rover->getCoordinateY() == $y && $rover->getCoordinateX() == $x) {
                }
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    public function drawRover(Rover $rover) {
        switch ($rover->getOrientation()) {
            case 'N':
                echo '↑';
                break;
            case 'E':
                echo '→';
                break;
            case 'S':
                echo '↓';
                break;
            case 'W':
                echo '←';
                break;
        }
    }

}

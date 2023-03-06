<?php

// the code is refactored with modular, reusable and independent functions
// constants are defined for the directions
// Remove the complexity of if-else..

declare(strict_types=1); // data types must be strictly checked during code execution

namespace App;

class Rover
{
    private const DIRECTION_NORTH = 1;
    private const DIRECTION_EAST = 2;
    private const DIRECTION_SOUTH = 3;
    private const DIRECTION_WEST = 4;

    private $direction;
    private $y;
    private $x;

    public function __construct(int $x, int $y, int $direction)
    {
        $this->direction = $direction;
        $this->y = $y;
        $this->x = $x;
    }

    // input parameter: sequence to move the robot
    public function receive(string $commandsSequence): void
    {
        // strlen for length
        $commandsSequenceLength = strlen($commandsSequence);

        // break down the sequence
        for ($i = 0; $i < $commandsSequenceLength; ++$i) {
            $command = substr($commandsSequence, $i, 1);

            switch ($command) {
                case 'f':
                    $this->move();
                    break;
                case 'l':
                    $this->rotateLeft();
                    break;
                case 'r':
                    $this->rotateRight();
                    break;
            }
        }
    }

    // to turn the rover to the right
    private function rotateLeft(): void
    {
        // if direction == NORD -> direction = WEST,  else direction -1 
        $this->direction = $this->direction === self::DIRECTION_NORTH ? self::DIRECTION_WEST : $this->direction - 1;
    }

    // to turn the rover to the left
    private function rotateRight(): void
    {
        // if direction == WEST -> direction = NORD,  esle direction + 1 
        $this->direction = $this->direction === self::DIRECTION_WEST ? self::DIRECTION_NORTH : $this->direction + 1;
    }

    // function for move rover 
    private function move(): void
    {
        // direction-dependent switch
        switch ($this->direction) {
            case self::DIRECTION_NORTH:
                $this->y++;
                break;
            case self::DIRECTION_EAST:
                $this->x++;
                break;
            case self::DIRECTION_SOUTH:
                $this->y--;
                break;
            case self::DIRECTION_WEST:
                $this->x--;
                break;
        }
    }
}


/* 
declare(strict_types=1);

namespace App;

class Rover
{
    private string $direction;
    private int $y;
    private int $x;

    public function __construct(int $x, int $y, string $direction)
    {
        $this->direction = $direction;
        $this->y = $y;
        $this->x = $x;
    }

    public function receive(string $commandsSequence): void
    {
        $commandsSequenceLenght = strlen($commandsSequence);
        for ($i = 0; $i < $commandsSequenceLenght; ++$i) {
            $command = substr($commandsSequence, $i, 1);
            if ($command === "l" || $command === "r") {
                // Rotate Rover
                if ($this->direction === "N") {
                    if ($command === "r") {
                        $this->direction = "E";
                    } else {
                        $this->direction = "W";
                    }
                } else if ($this->direction === "S") {
                    if ($command === "r") {
                        $this->direction = "W";
                    } else {
                        $this->direction = "E";
                    }
                } else if ($this->direction === "W") {
                    if ($command === "r") {
                        $this->direction = "N";
                    } else {
                        $this->direction = "S";
                    }
                } else {
                    if ($command === "r") {
                        $this->direction = "S";
                    } else {
                        $this->direction = "N";
                    }
                }
            } else {
                // Displace Rover
                $displacement1 = -1;

                if ($command === "f") {
                    $displacement1 = 1;
                }
                $displacement = $displacement1;

                if ($this->direction === "N") {
                    $this->y += $displacement;
                } else if ($this->direction === "S") {
                    $this->y -= $displacement;
                } else if ($this->direction === "W") {
                    $this->x -= $displacement;
                } else {
                    $this->x += $displacement;
                }
            }
        }
    }
}

*/ 
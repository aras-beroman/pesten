<?php

namespace App\Game;

class Player 
{
    public $name;
    private $playerCards = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addToHand($card)
    {
        array_push($this->playerCards,$card);
    }

    public function showHand()
    {
        echo $this->name.' has been dealt ';

        foreach ($this->playerCards as $card) {
            echo $card.' ';
        }
    }

    public function getPlayerCards()
    {
        return $this->playerCards;
    }

    public function removeFromHand($key)
    {
        unset($this->playerCards[$key]);
    }

    public function handEmpty()
    {
        return count($this->playerCards) == 0;
    }
}
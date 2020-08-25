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

    public function removeFromHand($key)
    {
        unset($this->playerCards[$key]);
    }

    public function showHand()
    {
        echo $this->name.' has been dealt ';

        foreach ($this->playerCards as $card) {
            echo $card.' ';
        }
    }

    public function amountOfCards()
    {
        return count($this->playerCards);
    }

    public function throwCard(GameManager $gameManager)
    {
        $topCardSuit = explode(";",$gameManager->topCard)[0];
        $topCardValue = explode(";",$gameManager->topCard)[1];

        foreach ($this->playerCards as $key => $playerCard) {
            $playerSuit = explode(";",$playerCard)[0];
            $playerValue = explode(";",$playerCard)[1];

            if (($topCardSuit == $playerSuit) || ($topCardValue == $playerValue)) {
                $gameManager->topCard = $playerCard;

                $this->removeFromHand($key);

                return true;

            }
        }

        return false;
    }
}
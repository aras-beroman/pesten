<?php

namespace App\Game;

class Deck
{
    public $cards = [];

    private $suits = ['&hearts;', '&diams;', '&clubs;', '&spades;'];
    private $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

    public function __construct()
    {
        foreach ($this->suits as $suit) {

            foreach ($this->values as $value) {

                $this->cards [] = $suit.$value;
            }
        }

        shuffle($this->cards);
    }

    public function getCard()
    {
        if (!$this->empty()) {

            $key = array_rand($this->cards,1);

            $card = $this->cards[$key];

            $this->remove($key);

            sort($this->cards);

            return $card;

        } else {

            return false;
        }
    }

    public function size() {

        return count($this->cards);
    }

    public function remove($key)
    {
        unset($this->cards[$key]);
    }

    public function empty()
    {
        return count($this->cards) == 0;
    }
}
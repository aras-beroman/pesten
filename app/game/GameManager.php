<?php

namespace App\Game;

class GameManager
{

    public $topCard;
    private $deck;
    private $players = [];

    public function __construct()
    {
        $this->deck = new Deck();
    }

    public function addPlayer(Player $player)
    {
        array_push($this->players,$player);
    }

    public function handOutCards()
    {
        foreach ($this->players as $player) {

            foreach (array_rand($this->deck->cards, 7) as $key) {
                $card = $this->deck->cards[$key];
                $player->addToHand($card);
                $this->deck->remove($key);
            }
        }

        sort($this->deck->cards);
    }

    public function topCard()
    {
        $this->topCard = $this->deck->getCard();

        return $this->topCard;
    }

    public function start()
    {
        echo 'Starting game with ';

        foreach ($this->players as $player) {
            echo $player->name.', ';
        }

        echo '<br>';

        foreach ($this->players as $player) {
            echo $player->showHand().'<br>';
        }

        $this->topCard();

        echo 'Top card is: '. $this->topCard .'<br>';

        do {
            foreach ($this->players as $player) {
                if ($player->throwCard($this)) {
                    echo $player->name . ' played ' . $this->topCard . '<br>';

                    if ($player->amountOfCards() == 0) {
                        die($player->name.' has won');
                    }

                } else {
                    $card = $this->deck->getCard();
                    $player->addToHand($card);

                    echo $player->name . ' does not have a suitable card, taking from deck ' . $card . '<br>';
                }

            }
        } while (!$this->deck->empty());

    }
}
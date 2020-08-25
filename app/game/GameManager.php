<?php

namespace App\Game;

class GameManager
{
    public $topCard;
    private $deck;
    private $players = [];
    private $startingGameWith = '';

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
        foreach ($this->players as $i => $player) {
            $this->startingGameWith .= $player->name.', ';
            
            foreach (array_rand($this->deck->cards, 7) as $key) {
                $card = $this->deck->cards[$key];

                $player->addToHand($card);

                $this->deck->remove($key);
            }
        }

        $this->deck->sort();
    }

    public function topCard()
    {
        $this->topCard = $this->deck->getCard();

        return $this->topCard;
    }

    public function startingPlayers()
    {
        $this->startingGameWith = rtrim($this->startingGameWith, ', ');

        echo 'Starting game with '. $this->startingGameWith;

        echo '<br>';

    }

    public function playerHasCardToPlay(Player $player)
    {
        $topCardSuit = explode(";",$this->topCard)[0];
        $topCardValue = explode(";",$this->topCard)[1];

        foreach ($player->getPlayerCards() as $key => $playerCard) {
            $playerSuit = explode(";",$playerCard)[0];
            $playerValue = explode(";",$playerCard)[1];

            if (($topCardSuit == $playerSuit) || ($topCardValue == $playerValue)) {
                $this->topCard = $playerCard;

                $player->removeFromHand($key);

                return true;
            }
        }

        return false;
    }

    public function start()
    {
        $this->startingPlayers();

        foreach ($this->players as $player) {
            echo $player->showHand().'<br>';
        }

        $this->topCard();

        echo 'Top card is: '. $this->topCard .'<br>';

        do {
            foreach ($this->players as $player) {
                if ($this->playerHasCardToPlay($player)) {
                    echo $player->name . ' played ' . $this->topCard . '<br>';

                    if ($player->handEmpty()) {
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
<?php

use App\Game\Player;
use App\Game\Deck;
use App\Game\GameManager;

include_once realpath("vendor/autoload.php");

$player1 = new Player('Aras');
$player2 = new Player('Selin');
$player3 = new Player('Nias');
$player4 = new Player('Farida');

$gameManager = new GameManager();

$gameManager->addPlayer($player1);
$gameManager->addPlayer($player2);
$gameManager->addPlayer($player3);
$gameManager->addPlayer($player4);

$gameManager->handOutCards();

$gameManager->start();

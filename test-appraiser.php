<?php

use Alura\Auction\Model\Auction;
use Alura\Auction\Model\Bid;
use Alura\Auction\Model\User;
use Alura\Auction\Service\Appraiser;

require 'vendor/autoload.php';

$auction = new Auction('Fiat 147 0KM');

$maria = new User('Maria');
$joao = new User('João');

$auction->receiveBid(new Bid($joao, 2000));
$auction->receiveBid(new Bid($maria, 2500));

$appraiser = new Appraiser();
$appraiser->evaluates($auction);

$biggestValue = $appraiser->getBiggestValue();

echo $biggestValue;

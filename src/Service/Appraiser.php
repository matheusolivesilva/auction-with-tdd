<?php

namespace Alura\Auction\Service;

use Alura\Auction\Model\Auction;

class Appraiser
{
    private $biggestValue;

    public function evaluates(Auction $auction): void
    {
        $bids = $auction->getBids();
        $lastBid = $bids[count($bids) - 1];
        $this->biggestValue = $lastBid->getValue();
    }


    public function getBiggestValue(): float
    {
        return $this->biggestValue;
    }
}


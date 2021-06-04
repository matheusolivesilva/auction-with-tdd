<?php

namespace Alura\Auction\Service;

use Alura\Auction\Model\Auction;

class Appraiser
{
    private $biggestValue = -INF;
    private $smallestValue = INF;

    public function evaluates(Auction $auction): void
    {
        foreach ($auction->getBids() as $bid) {
            if ($bid->getValue() > $this->biggestValue) {
                $this->biggestValue = $bid->getValue();
            } 
            if($bid->getValue() < $this->smallestValue) {
                $this->smallestValue = $bid->getValue();
            }
        }
    }

    public function getBiggestValue(): float
    {
        return $this->biggestValue;
    }

    public function getSmallestValue(): float
    {
        return $this->smallestValue;
    }
}


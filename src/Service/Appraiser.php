<?php

namespace Alura\Auction\Service;

use Alura\Auction\Model\Auction;
use Alura\Auction\Model\Bid;

class Appraiser
{
    private $biggestValue = -INF;
    private $smallestValue = INF;
    private $biggestsBids;

    public function evaluates(Auction $auction): void
    {
        if ($auction->isFinished()) {
            throw new \DomainException('Auction is finished');
        }
        if (empty($auction->getBids())) {
            throw new \DomainException('It\'s not possible to appraise an empty auction');
        }
        foreach ($auction->getBids() as $bid) {
            if ($bid->getValue() > $this->biggestValue) {
                $this->biggestValue = $bid->getValue();
            } 
            if($bid->getValue() < $this->smallestValue) {
                $this->smallestValue = $bid->getValue();
            }
        }
        $bids = $auction->getBids();
        usort($bids, function(Bid $bid1, Bid $bid2) {
            return $bid2->getValue() - $bid1->getValue();
        });
        $this->biggestsBids = array_slice($bids, 0, 3);
    }

    public function getBiggestValue(): float
    {
        return $this->biggestValue;
    }

    public function getSmallestValue(): float
    {
        return $this->smallestValue;
    }

    /**
     * @return Bid[]
     */
    public function getBiggestBids(): array
    {
        return $this->biggestsBids;
    }
}


<?php

namespace Alura\Auction\Model;

class Auction 
{
    /** @var Bid[] */
    private $bids;
    /** @var string */
    private $description;

    public function __construct(string $description)
    {
        $this->description = $description;
        $this->bids = [];
    }

    public function receiveBid(Bid $bid)
    {
        $this->bids[] = $bid;
    }

    /**
     * @return Bid[]
     */
    public function getBids(): array
    {
        return $this->bids;
    }
}

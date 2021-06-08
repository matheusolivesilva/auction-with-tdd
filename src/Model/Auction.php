<?php

namespace Alura\Auction\Model;

class Auction 
{
    /** @var Bid[] */
    private $bids;
    /** @var string */
    private $description;
    /** @var bool */
    private $finished;

    public function __construct(string $description)
    {
        $this->description = $description;
        $this->bids = [];
        $this->finished = false;
    }

    public function receiveBid(Bid $bid)
    {
        if (!empty($this->bids) && $this->isFromLastUser($bid)) {
            throw new \DomainException('User cannot purpose 2 followed bids');
        }
        $totalBidsByUser = $this->amountOfBidsByUser($bid->getUser());
        if ($totalBidsByUser >= 5) {
            throw new \DomainException('User cannot purpose more than 5 bids by auction');
        }
        $this->bids[] = $bid;
    }

    /**
     * @return Bid[]
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    public function finalize()
    {
        $this->finished = true;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    /**
     * @param Bid $bid
     * @return bool
     */
    private function isFromLastUser(Bid $bid): bool
    {
        $lastBid = $this->bids[array_key_last($this->bids)];
        return $bid->getUser() === $lastBid->getUser();
    }

    private function amountOfBidsByUser(User $user): int
    {
        $totalBidsByUser = array_reduce(
            $this->bids,
            function (int $accumulatedTotal, Bid $currentBid) use ($user) {
                if ($currentBid->getUser() === $user) {
                    return $accumulatedTotal + 1;
                }
                return $accumulatedTotal;
            },
            0
        );
        return $totalBidsByUser;
    }

}

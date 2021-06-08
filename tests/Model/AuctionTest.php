<?php
namespace Alura\Auction\Tests\Model;

use Alura\Auction\Model\Auction;
use Alura\Auction\Model\Bid;
use Alura\Auction\Model\User;
use PHPUnit\Framework\TestCase;

class AuctionTest extends TestCase
{
    public function testAuctionShouldNotReceiveRepeatedBids()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('User cannot purpose 2 followed bids');
        $auction = new Auction('Lamborghini Veneno');
        $ana = new User('Ana');
        $auction->receiveBid(new Bid($ana, 1000));
        $auction->receiveBid(new Bid($ana, 1500));
    }

    public function testAuctionShouldNotReceiveMoreThan5BidsByUser()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('User cannot purpose more than 5 bids by auction');
        $auction = new Auction('Red Masserati');
        $john = new User('John');
        $maria = new User('Maria');

        $auction->receiveBid(new Bid($john, 1000));
        $auction->receiveBid(new Bid($maria, 1500));
        $auction->receiveBid(new Bid($john, 2000));
        $auction->receiveBid(new Bid($maria, 2500));
        $auction->receiveBid(new Bid($john, 3000));
        $auction->receiveBid(new Bid($maria, 3500));
        $auction->receiveBid(new Bid($john, 4000));
        $auction->receiveBid(new Bid($maria, 4500));
        $auction->receiveBid(new Bid($john, 5000));
        $auction->receiveBid(new Bid($maria, 5500));
        $auction->receiveBid(new Bid($john, 6000));
    }


    /**
     * @dataProvider generateBids
     */
    public function testAuctionShouldReceiveBids(
        int $bidsAmount,
        Auction $auction,
        array $values
    ) {
        static::assertCount($bidsAmount, $auction->getBids());
        foreach ($values as $i => $expectedValue) {
            static::assertEquals($expectedValue, $auction->getBids()[$i]->getValue());
        }
    }


    public function generateBids()
    {
        $john = new User('John');
        $maria = new User('Maria');
        $auctionWith2Bids = new Auction('Porsche');
        $auctionWith2Bids->receiveBid(new Bid($john, 1000));
        $auctionWith2Bids->receiveBid(new Bid($maria, 2000));

        $auctionWith1Bids = new Auction('Mercedes Benz');
        $auctionWith1Bids->receiveBid(new Bid($maria, 5000));

        return [
            '2-bids' => [2, $auctionWith2Bids, [1000, 2000]],
            '1-bid' => [1, $auctionWith1Bids, [5000]]
        ];
    }
}

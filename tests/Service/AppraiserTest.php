<?php
namespace Alura\Auction\Tests\Service;

use PHPUnit\Framework\TestCase;
use Alura\Auction\Model\Auction;
use Alura\Auction\Model\Bid;
use Alura\Auction\Model\User;
use Alura\Auction\Service\Appraiser;

class AppraiserTest extends TestCase
{

   /** @var Appraiser */
   private $appraiser;

   protected function setUp(): void
   {
       $this->appraiser = new Appraiser();
   }

   /**
    * @dataProvider auctionInRandomOrder
    * @dataProvider auctionInAscendingOrder
    * @dataProvider auctionInDescendingOrder
    */
    public function testAppraiserShouldFindTheBiggestBidsValue(Auction $auction)
    {
        $this->appraiser->evaluates($auction);
        $biggestValue = $this->appraiser->getBiggestValue();
        self::assertEquals(2500, $biggestValue);
    }


   /**
    * @dataProvider auctionInRandomOrder
    * @dataProvider auctionInAscendingOrder
    * @dataProvider auctionInDescendingOrder
    */
    public function testAppraiserShouldFindTheSmallestBidsValue(Auction $auction)
    {
        $this->appraiser->evaluates($auction);
        $smallestValue = $this->appraiser->getSmallestValue();
        self::assertEquals(1700, $smallestValue);
    }

   /**
    * @dataProvider auctionInRandomOrder
    * @dataProvider auctionInAscendingOrder
    * @dataProvider auctionInDescendingOrder
    */
    public function testAppraiserShouldSearch3BiggestValues(Auction $auction)
    {
        $this->appraiser->evaluates($auction);
        $biggest = $this->appraiser->getBiggestBids();
        static::assertCount(3, $biggest);
        static::assertEquals(2500, $biggest[0]->getValue());
        static::assertEquals(2000, $biggest[1]->getValue());
        static::assertEquals(1700, $biggest[2]->getValue());
    }

    public function testEmptyAuctionCouldNotBeEvaluated()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('It\'s not possible to appraise an empty auction');
        $auction = new Auction('Ferrari Testarossa');
        $this->appraiser->evaluates($auction);
    }

    public function testFinishedAuctionCouldNotBeEvaluated()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Auction is finished');
        $auction = new Auction('Ferrari Testarossa');
        $auction->receiveBid(new Bid(new User('Test'), 2000));
        $auction->finalize();
        $this->appraiser->evaluates($auction);
    }

    /* ----- DATA ----- */
    public function auctionInAscendingOrder()
    {
        $auction = new Auction('Ferrari Testarossa');
        $maria = new User('Maria');
        $john = new User('John');
        $ana = new User('Ana');
        $auction->receiveBid(new Bid($ana, 1700));
        $auction->receiveBid(new Bid($john, 2000));
        $auction->receiveBid(new Bid($maria, 2500));
        return [
            'ascending-order' => [$auction]
        ];
    }

    public function auctionInDescendingOrder()
    {
        $auction = new Auction('Ferrari Testarossa');
        $maria = new User('Maria');
        $john = new User('John');
        $ana = new User('Ana');
        $auction->receiveBid(new Bid($maria, 2500));
        $auction->receiveBid(new Bid($john, 2000));
        $auction->receiveBid(new Bid($ana, 1700));
        return [
            'descending-order' => [$auction]
        ];
    }

    public function auctionInRandomOrder()
    {
        $auction = new Auction('Ferrari Testarossa');
        $maria = new User('Maria');
        $john = new User('John');
        $ana = new User('Ana');
        $auction->receiveBid(new Bid($john, 2000));
        $auction->receiveBid(new Bid($maria, 2500));
        $auction->receiveBid(new Bid($ana, 1700));
        return [
            'random-order' => [$auction]
        ];
    }
}

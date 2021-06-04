<?php
namespace Alura\Auction\Tests\Service;

use PHPUnit\Framework\TestCase;
use Alura\Auction\Model\Auction;
use Alura\Auction\Model\Bid;
use Alura\Auction\Model\User;
use Alura\Auction\Service\Appraiser;

class AppraiserTest extends TestCase
{
   public function testAppraiserShouldFindTheBiggestValueOfBidInDescendingOrder()
   {

        $auction = new Auction('Fiat 147 0KM');

        $maria = new User('Maria');
        $joao = new User('João');

        $auction->receiveBid(new Bid($maria, 2500));
        $auction->receiveBid(new Bid($joao, 2000));

        $appraiser = new Appraiser();
        $appraiser->evaluates($auction);

        $biggestValue = $appraiser->getBiggestValue();

        self::assertEquals(2500, $biggestValue);
   }

   public function testAppraiserShouldFindTheBiggestValueOfBidInAscendingOrder()
   {

        $auction = new Auction('Fiat 147 0KM');

        $maria = new User('Maria');
        $joao = new User('João');

        $auction->receiveBid(new Bid($joao, 2000));
        $auction->receiveBid(new Bid($maria, 2500));

        $appraiser = new Appraiser();
        $appraiser->evaluates($auction);

        $biggestValue = $appraiser->getBiggestValue();

        self::assertEquals(2500, $biggestValue);
   }

   public function testAppraiserShouldFindTheSmallestValueOfBidInAscendingOrder()
   {

        $auction = new Auction('Fiat 147 0KM');

        $maria = new User('Maria');
        $joao = new User('João');

        $auction->receiveBid(new Bid($maria, 2500));
        $auction->receiveBid(new Bid($joao, 2000));

        $appraiser = new Appraiser();
        $appraiser->evaluates($auction);

        $smallestValue = $appraiser->getSmallestValue();

        self::assertEquals(2000, $smallestValue);
   }

   public function testAppraiserShouldFindTheSmallestValueOfBidInDescendingOrder()
   {

        $auction = new Auction('Fiat 147 0KM');

        $maria = new User('Maria');
        $joao = new User('João');

        $auction->receiveBid(new Bid($joao, 2000));
        $auction->receiveBid(new Bid($maria, 2500));

        $appraiser = new Appraiser();
        $appraiser->evaluates($auction);

        $smallestValue = $appraiser->getSmallestValue();

        self::assertEquals(2000, $smallestValue);
   }
}

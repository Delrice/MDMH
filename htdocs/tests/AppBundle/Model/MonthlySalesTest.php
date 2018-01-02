<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 02/01/2018
 * Time: 15:12
 */

namespace Tests\AppBundle\Model;

use AppBundle\AppBundle;
use AppBundle\Document\Restaurant;
use AppBundle\Model\MonthlySales;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;


class MonthlySalesTest extends TestCase
{
    /**
     * @var MonthlySales
     */
    private $monthlySales;

    public function setUp()
    {
        $mockedRestaurant = $this->createMock('AppBundle\Document\Restaurant');
        $this->monthlySales = new MonthlySales($mockedRestaurant, 2018, 1);
    }

    public function testMonthlySalesContruct()
    {
        $this->assertInstanceOf(MonthlySales::class, $this->monthlySales);
    }

    public function testAccessors()
    {
        // year
        $this->assertEquals(2018, $this->monthlySales->getYear());

        // month
        $this->assertEquals(1, $this->monthlySales->getMonth());

        // dailySales
        $this->assertInstanceOf(ArrayCollection::class, $this->monthlySales->getDailySales());

        // Restaurant
        $this->assertInstanceOf(Restaurant::class, $this->monthlySales->getRestaurant());
    }
}
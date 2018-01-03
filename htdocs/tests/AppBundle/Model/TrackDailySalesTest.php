<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 03/01/2018
 * Time: 14:12
 */

namespace Tests\AppBundle\Model;


use PHPUnit\Framework\TestCase;
use AppBundle\Model\TrackDailySales;

class TrackDailySalesTest extends TestCase
{
    /**
     * @var TrackDailySales
     */
    private $trackDailySales;

    public function setUp()
    {
        $this->trackDailySales = new TrackDailySales('2018', '01', '01');
    }

    public function testTrackDailySalesConstruct()
    {
        $this->assertInstanceOf(TrackDailySales::class, $this->trackDailySales);
    }

    public function testAccessors()
    {
        // year
        $this->assertEquals(2018, $this->trackDailySales->getYear());

        // month
        $this->assertEquals(1, $this->trackDailySales->getMonth());

        // day
        $this->assertEquals(1, $this->trackDailySales->getDay());

        // date
        $this->assertSame('01/01/2018', $this->trackDailySales->getDate());
    }
}
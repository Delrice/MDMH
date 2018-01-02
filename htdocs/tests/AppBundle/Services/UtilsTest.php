<?php
/**
 * Created by PhpStorm.
 * User: fabriceperez
 * Date: 02/01/2018
 * Time: 14:49
 */

namespace Tests\AppBundle\Services;

use PHPUnit\Framework\TestCase;
use AppBundle\Services\Utils;

class UtilsTest extends TestCase
{
    private $utilsService;

    protected function setUp()
    {
        $this->utilsService = new Utils();
    }

    public function testIfAllTwelveMonthsAreAvailable()
    {
        $this->assertCount(12, $this->utilsService->getMonths());
    }

    public function testIfTheGoodMonthsShortNamesAreReturned()
    {
        $this->assertEquals('jan', $this->utilsService->getMonthShortName(1));
        $this->assertEquals('jun', $this->utilsService->getMonthShortName(6));
    }

    public function testIfTheGoodMonthsNumbersAreReturned()
    {
        $this->assertEquals(1, $this->utilsService->getMonthNumber('jan'));
        $this->assertEquals(6, $this->utilsService->getMonthNumber('jun'));
    }

    /**
     * @dataProvider percentAndColors
     */
    public function testThePercentageAndColorizationOfDatas($prevision, $realized, $expectedDatas)
    {
        $this->assertSame($expectedDatas, $this->utilsService->calculateAndColorizePercentProgression($prevision, $realized));
    }

    public function percentAndColors()
    {
        yield [100, 50, [50.0, 'danger', 'red']];
        yield [100, 80, [80.0, 'yellow', 'yellow']];
        yield [100, 100, [100.0, 'success', 'green']];
        yield [100, 110, [110.0, 'primary', 'blue']];
    }
}
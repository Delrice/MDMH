<?php

namespace AppBundle\DataFixtures\MongoDB;

use AppBundle\Document\DailySale;
use AppBundle\Document\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class DailySaleMHFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface, DependentFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
    }

    public function load(ObjectManager $manager)
    {
        $dailySaleListToCreate = [
            'MH' => [
                '2017' =>[
                    '01' => [
                        ['sale' => 19384, 'budget' => 18800],
                        ['sale' => 14023, 'budget' => 9400],
                        ['sale' => 8819, 'budget' => 11200],
                        ['sale' => 11656, 'budget' => 13800],
                        ['sale' => 10010, 'budget' => 10400],
                        ['sale' => 16397, 'budget' => 16400],
                        ['sale' => 18249, 'budget' => 18600],
                        ['sale' => 14985, 'budget' => 16000],
                        ['sale' => 8684, 'budget' => 8400],
                        ['sale' => 9643, 'budget' => 9500],
                        ['sale' => 13155, 'budget' => 12400],
                        ['sale' => 10267, 'budget' => 9900],
                        ['sale' => 14897, 'budget' => 15200],
                        ['sale' => 19002, 'budget' => 18600],
                        ['sale' => 14992, 'budget' => 15400],
                        ['sale' => 8161, 'budget' => 8100],
                        ['sale' => 8763, 'budget' => 9000],
                        ['sale' => 11844, 'budget' => 11900],
                        ['sale' => 10628, 'budget' => 9800],
                        ['sale' => 16473, 'budget' => 15100],
                        ['sale' => 19978, 'budget' => 18500],
                        ['sale' => 15828, 'budget' => 16100],
                        ['sale' => 8490, 'budget' => 7900],
                        ['sale' => 9193, 'budget' => 9200],
                        ['sale' => 12075, 'budget' => 12200],
                        ['sale' => 9089, 'budget' => 10000],
                        ['sale' => 15485, 'budget' => 15400],
                        ['sale' => 18141, 'budget' => 18600],
                        ['sale' => 15955, 'budget' => 15000],
                        ['sale' => 7930, 'budget' => 9200],
                        ['sale' => 9886, 'budget' => 10000],
                    ],
                    '02' => [
                        ['sale' => 12915, 'budget' => 12800],
                        ['sale' => 10476, 'budget' => 10000],
                        ['sale' => 16732, 'budget' => 16200],
                        ['sale' => 17145, 'budget' => 18000],
                        ['sale' => 16357, 'budget' => 16000],
                        ['sale' => 12038, 'budget' => 11500],
                        ['sale' => 12027, 'budget' => 12200],
                        ['sale' => 14720, 'budget' => 14000],
                        ['sale' => 14043, 'budget' => 13000],
                        ['sale' => 16634, 'budget' => 16900],
                        ['sale' => 17252, 'budget' => 17500],
                        ['sale' => 17117, 'budget' => 16500],
                        ['sale' => 11700, 'budget' => 11000],
                        ['sale' => 14550, 'budget' => 11800],
                        ['sale' => 13251, 'budget' => 13200],
                        ['sale' => 13433, 'budget' => 12200],
                        ['sale' => 15310, 'budget' => 16600],
                        ['sale' => 17348, 'budget' => 17000],
                        ['sale' => 16004, 'budget' => 16000],
                        ['sale' => 8262, 'budget' => 8200],
                        ['sale' => 9144, 'budget' => 9400],
                        ['sale' => 12419, 'budget' => 11800],
                        ['sale' => 9803, 'budget' => 10100],
                        ['sale' => 14944, 'budget' => 16000],
                        ['sale' => 17680, 'budget' => 17400],
                        ['sale' => 15305, 'budget' => 15400],
                        ['sale' => 9219, 'budget' => 8300],
                        ['sale' => 10120, 'budget' => 9000],
                    ],
                    '03' => [
                        ['sale' => 13634, 'budget' => 13000],
                        ['sale' => 11284, 'budget' => 11200],
                        ['sale' => 17286, 'budget' => 17400],
                        ['sale' => 18602, 'budget' => 18900],
                        ['sale' => 16173, 'budget' => 16500],
                        ['sale' => 11080, 'budget' => 9000],
                        ['sale' => 10614, 'budget' => 9700],
                        ['sale' => 13213, 'budget' => 12600],
                        ['sale' => 11332, 'budget' => 11000],
                        ['sale' => 16026, 'budget' => 16700],
                        ['sale' => 17976, 'budget' => 18700],
                        ['sale' => 17255, 'budget' => 16300],
                        ['sale' => 8880, 'budget' => 8700],
                        ['sale' => 9238, 'budget' => 9300],
                        ['sale' => 12932, 'budget' => 12300],
                        ['sale' => 9982, 'budget' => 10000],
                        ['sale' => 15730, 'budget' => 15400],
                        ['sale' => 16920, 'budget' => 17300],
                        ['sale' => 15566, 'budget' => 15200],
                        ['sale' => 8567, 'budget' => 8600],
                        ['sale' => 8413, 'budget' => 9000],
                        ['sale' => 11909, 'budget' => 11700],
                        ['sale' => 11049, 'budget' => 10200],
                        ['sale' => 16437, 'budget' => 15700],
                        ['sale' => 18397, 'budget' => 18000],
                        ['sale' => 17727, 'budget' => 15000],
                        ['sale' => 8381, 'budget' => 8800],
                        ['sale' => 9726, 'budget' => 9500],
                        ['sale' => 12680, 'budget' => 12300],
                        ['sale' => 11229, 'budget' => 11000],
                        ['sale' => 17110, 'budget' => 17000],
                    ],
                    '04' => [
                        ['sale' => 17922, 'budget' => 18800],
                        ['sale' => 15859, 'budget' => 17400],
                        ['sale' => 11758, 'budget' => 12800],
                        ['sale' => 12958, 'budget' => 13200],
                        ['sale' => 14552, 'budget' => 14800],
                        ['sale' => 15361, 'budget' => 14000],
                        ['sale' => 17185, 'budget' => 17600],
                        ['sale' => 16898, 'budget' => 18200],
                        ['sale' => 17163, 'budget' => 17200],
                        ['sale' => 13394, 'budget' => 12500],
                        ['sale' => 13515, 'budget' => 13000],
                        ['sale' => 14294, 'budget' => 14200],
                        ['sale' => 13385, 'budget' => 13400],
                        ['sale' => 16881, 'budget' => 17000],
                        ['sale' => 16137, 'budget' => 18100],
                        ['sale' => 14314, 'budget' => 16000],
                        ['sale' => 15167, 'budget' => 15000],
                        ['sale' => 9670, 'budget' => 10000],
                        ['sale' => 12245, 'budget' => 13000],
                        ['sale' => 11439, 'budget' => 11000],
                        ['sale' => 14549, 'budget' => 16800],
                        ['sale' => 17719, 'budget' => 18000],
                        ['sale' => 16783, 'budget' => 16500],
                        ['sale' => 9246, 'budget' => 9500],
                        ['sale' => 10007, 'budget' => 9900],
                        ['sale' => 13059, 'budget' => 12600],
                        ['sale' => 12026, 'budget' => 11200],
                        ['sale' => 17609, 'budget' => 16900],
                        ['sale' => 18481, 'budget' => 18100],
                        ['sale' => 19265, 'budget' => 16300],
                    ],
                    '05' => [
                        ['sale' => 17916, 'budget' => 15500],
                        ['sale' => 10767, 'budget' => 10000],
                        ['sale' => 13089, 'budget' => 13500],
                        ['sale' => 11396, 'budget' => 11000],
                        ['sale' => 18133, 'budget' => 17400],
                        ['sale' => 18485, 'budget' => 17000],
                        ['sale' => 18621, 'budget' => 15500],
                        ['sale' => 15299, 'budget' => 15800],
                        ['sale' => 9791, 'budget' => 10000],
                        ['sale' => 13562, 'budget' => 12700],
                        ['sale' => 11783, 'budget' => 11300],
                        ['sale' => 16627, 'budget' => 16800],
                        ['sale' => 17061, 'budget' => 17900],
                        ['sale' => 17027, 'budget' => 15900],
                        ['sale' => 8976, 'budget' => 9500],
                        ['sale' => 9131, 'budget' => 9800],
                        ['sale' => 11852, 'budget' => 12800],
                        ['sale' => 10742, 'budget' => 10800],
                        ['sale' => 15431, 'budget' => 15600],
                        ['sale' => 16823, 'budget' => 16000],
                        ['sale' => 15987, 'budget' => 15800],
                        ['sale' => 8976, 'budget' => 9000],
                        ['sale' => 10043, 'budget' => 9500],
                        ['sale' => 15146, 'budget' => 16200],
                        ['sale' => 16231, 'budget' => 17500],
                        ['sale' => 14495, 'budget' => 17400],
                        ['sale' => 14135, 'budget' => 17100],
                        ['sale' => 18690, 'budget' => 19800],
                        ['sale' => 8959, 'budget' => 9400],
                        ['sale' => 9898, 'budget' => 10500],
                        ['sale' => 12723, 'budget' => 14000],
                    ],
                    '06' => [
                        ['sale' => 11391, 'budget' => 11400],
                        ['sale' => 16155, 'budget' => 16700],
                        ['sale' => 15790, 'budget' => 18000],
                        ['sale' => 14795, 'budget' => 18500],
                        ['sale' => 16421, 'budget' => 16000],
                        ['sale' => 10281, 'budget' => 11700],
                        ['sale' => 14208, 'budget' => 13500],
                        ['sale' => 11412, 'budget' => 11700],
                        ['sale' => 14744, 'budget' => 15000],
                        ['sale' => 14936, 'budget' => 16000],
                        ['sale' => 15991, 'budget' => 17200],
                        ['sale' => 7020, 'budget' => 9900],
                        ['sale' => 10620, 'budget' => 11400],
                        ['sale' => 13404, 'budget' => 13500],
                        ['sale' => 12633, 'budget' => 11100],
                        ['sale' => 15772, 'budget' => 16500],
                        ['sale' => 15084, 'budget' => 17500],
                        ['sale' => 15125, 'budget' => 15400],
                        ['sale' => 9431, 'budget' => 10000],
                        ['sale' => 10684, 'budget' => 10400],
                        ['sale' => 13468, 'budget' => 12000],
                        ['sale' => 11808, 'budget' => 11400],
                        ['sale' => 15931, 'budget' => 15200],
                        ['sale' => 14277, 'budget' => 14400],
                        ['sale' => 18918, 'budget' => 15400],
                        ['sale' => 11760, 'budget' => 10400],
                        ['sale' => 11876, 'budget' => 11500],
                        ['sale' => 15128, 'budget' => 13000],
                        ['sale' => 13456, 'budget' => 12800],
                        ['sale' => 17182, 'budget' => 15500],
                    ],
                    '07' => [
                        ['sale' => 17198, 'budget' => 15500],
                        ['sale' => 17205, 'budget' => 16200],
                        ['sale' => 11624, 'budget' => 12600],
                        ['sale' => 13242, 'budget' => 14500],
                        ['sale' => 15998, 'budget' => 15900],
                        ['sale' => 15486, 'budget' => 15200],
                        ['sale' => 16880, 'budget' => 17700],
                        ['sale' => 17095, 'budget' => 16700],
                        ['sale' => 19093, 'budget' => 17600],
                        ['sale' => 14068, 'budget' => 15300],
                        ['sale' => 14043, 'budget' => 16200],
                        ['sale' => 14828, 'budget' => 15500],
                        ['sale' => 15077, 'budget' => 14200],
                        ['sale' => 17462, 'budget' => 17800],
                        ['sale' => 16078, 'budget' => 15600],
                        ['sale' => 19758, 'budget' => 18000],
                        ['sale' => 14232, 'budget' => 13000],
                        ['sale' => 12988, 'budget' => 13000],
                        ['sale' => 13139, 'budget' => 14000],
                        ['sale' => 13114, 'budget' => 12700],
                        ['sale' => 17346, 'budget' => 18000],
                        ['sale' => 17039, 'budget' => 17000],
                        ['sale' => 19101, 'budget' => 16200],
                        ['sale' => 14909, 'budget' => 12800],
                        ['sale' => 13954, 'budget' => 12400],
                        ['sale' => 15288, 'budget' => 15300],
                        ['sale' => 14832, 'budget' => 15100],
                        ['sale' => 17795, 'budget' => 17800],
                        ['sale' => 19065, 'budget' => 18200],
                        ['sale' => 18930, 'budget' => 18500],
                        ['sale' => 16021, 'budget' => 14500],
                    ],
                    '08' => [
                        ['sale' => 15520, 'budget' => 15000],
                        ['sale' => 16308, 'budget' => 15900],
                        ['sale' => 16288, 'budget' => 15500],
                        ['sale' => 19328, 'budget' => 19200],
                        ['sale' => 19935, 'budget' => 19000],
                        ['sale' => 22026, 'budget' => 18900],
                        ['sale' => 18292, 'budget' => 17100],
                        ['sale' => 18674, 'budget' => 16900],
                        ['sale' => 18489, 'budget' => 16800],
                        ['sale' => 17935, 'budget' => 16100],
                        ['sale' => 22139, 'budget' => 18000],
                        ['sale' => 21196, 'budget' => 18200],
                        ['sale' => 19566, 'budget' => 18000],
                        ['sale' => 17444, 'budget' => 17800],
                        ['sale' => 19218, 'budget' => 20000],
                        ['sale' => 17770, 'budget' => 16600],
                        ['sale' => 17573, 'budget' => 16700],
                        ['sale' => 18974, 'budget' => 18100],
                        ['sale' => 20602, 'budget' => 20000],
                        ['sale' => 21539, 'budget' => 18600],
                        ['sale' => 16592, 'budget' => 15600],
                        ['sale' => 14792, 'budget' => 14200],
                        ['sale' => 16979, 'budget' => 15400],
                        ['sale' => 19669, 'budget' => 15800],
                        ['sale' => 17054, 'budget' => 16200],
                        ['sale' => 17446, 'budget' => 17200],
                        ['sale' => 18299, 'budget' => 17500],
                        ['sale' => 13988, 'budget' => 15400],
                        ['sale' => 14095, 'budget' => 15000],
                        ['sale' => 16480, 'budget' => 15800],
                        ['sale' => 16924, 'budget' => 14500],
                    ],
                    '09' => [
                        ['sale' => 19327, 'budget' => 16500],
                        ['sale' => 19511, 'budget' => 17100],
                        ['sale' => 18455, 'budget' => 16900],
                        ['sale' => 12575, 'budget' => 10000],
                        ['sale' => 12121, 'budget' => 10500],
                        ['sale' => 14910, 'budget' => 13000],
                        ['sale' => 11351, 'budget' => 11600],
                        ['sale' => 18218, 'budget' => 17100],
                        ['sale' => 18878, 'budget' => 16400],
                        ['sale' => 17644, 'budget' => 16100],
                        ['sale' => 9381, 'budget' => 10000],
                        ['sale' => 11166, 'budget' => 9900],
                        ['sale' => 13148, 'budget' => 11500],
                        ['sale' => 10542, 'budget' => 11400],
                        ['sale' => 17563, 'budget' => 15900],
                        ['sale' => 18808, 'budget' => 17800],
                        ['sale' => 17495, 'budget' => 15500],
                        ['sale' => 8102, 'budget' => 8800],
                        ['sale' => 9118, 'budget' => 8500],
                        ['sale' => 12380, 'budget' => 11800],
                        ['sale' => 9992, 'budget' => 9900],
                        ['sale' => 17075, 'budget' => 16300],
                        ['sale' => 17958, 'budget' => 16300],
                        ['sale' => 18268, 'budget' => 16500],
                        ['sale' => 8691, 'budget' => 8200],
                        ['sale' => 9768, 'budget' => 8800],
                        ['sale' => 12361, 'budget' => 12100],
                        ['sale' => 9979, 'budget' => 11000],
                        ['sale' => 17158, 'budget' => 16800],
                        ['sale' => 18388, 'budget' => 17800],
                    ],
                    '10' => [
                        ['sale' => 18992, 'budget' => 16500],
                        ['sale' => 9609, 'budget' => 9900],
                        ['sale' => 10646, 'budget' => 10500],
                        ['sale' => 14716, 'budget' => 15200],
                        ['sale' => 12655, 'budget' => 12000],
                        ['sale' => 17804, 'budget' => 17500],
                        ['sale' => 19734, 'budget' => 20000],
                        ['sale' => 18358, 'budget' => 17200],
                        ['sale' => 10042, 'budget' => 9500],
                        ['sale' => 12764, 'budget' => 10000],
                        ['sale' => 13035, 'budget' => 13300],
                        ['sale' => 12427, 'budget' => 10300],
                        ['sale' => 18783, 'budget' => 16900],
                        ['sale' => 19611, 'budget' => 19200],
                        ['sale' => 18458, 'budget' => 16800],
                        ['sale' => 9848, 'budget' => 9200],
                        ['sale' => 10597, 'budget' => 10000],
                        ['sale' => 12353, 'budget' => 13200],
                        ['sale' => 11046, 'budget' => 10000],
                        ['sale' => 17947, 'budget' => 17500],
                        ['sale' => 18780, 'budget' => 17200],
                        ['sale' => 19229, 'budget' => 16500],
                        ['sale' => 12222, 'budget' => 13200],
                        ['sale' => 12988, 'budget' => 14200],
                        ['sale' => 14331, 'budget' => 15200],
                        ['sale' => 15755, 'budget' => 15400],
                        ['sale' => 19646, 'budget' => 18200],
                        ['sale' => 19276, 'budget' => 18000],
                        ['sale' => 18991, 'budget' => 17900],
                        ['sale' => 14356, 'budget' => 14000],
                        ['sale' => 16911, 'budget' => 15500],
                    ],
                    '11' => [
                        ['sale' => 18906, 'budget' => 18000],
                        ['sale' => 15338, 'budget' => 12000],
                        ['sale' => 19177, 'budget' => 17200],
                        ['sale' => 16287, 'budget' => 19500],
                        ['sale' => 19563, 'budget' => 16500],
                        ['sale' => 10755, 'budget' => 9300],
                        ['sale' => 11902, 'budget' => 10800],
                        ['sale' => 13608, 'budget' => 13500],
                        ['sale' => 11049, 'budget' => 10500],
                        ['sale' => 18261, 'budget' => 17900],
                        ['sale' => 18109, 'budget' => 18000],
                        ['sale' => 18681, 'budget' => 16500],
                        ['sale' => 9941, 'budget' => 9000],
                        ['sale' => 10900, 'budget' => 10500],
                        ['sale' => 12936, 'budget' => 13000],
                        ['sale' => 10926, 'budget' => 11000],
                        ['sale' => 17388, 'budget' => 16700],
                        ['sale' => 19642, 'budget' => 20000],
                        ['sale' => 17297, 'budget' => 16500],
                        ['sale' => 8450, 'budget' => 9000],
                        ['sale' => 9938, 'budget' => 11000],
                        ['sale' => 11483, 'budget' => 14000],
                        ['sale' => 10791, 'budget' => 12000],
                        ['sale' => 16462, 'budget' => 17200],
                        ['sale' => 18418, 'budget' => 19000],
                        ['sale' => 16061, 'budget' => 16400],
                        ['sale' => 8651, 'budget' => 8900],
                        ['sale' => 9948, 'budget' => 10800],
                        ['sale' => 12967, 'budget' => 13500],
                        ['sale' => 11715, 'budget' => 11800],
                    ],
                    '12' => [
                        ['sale' => 17217, 'budget' => 17500],
                        ['sale' => 19340, 'budget' => 19200],
                        ['sale' => 18984, 'budget' => 17000],
                        ['sale' => 9681, 'budget' => 10400],
                        ['sale' => 13155, 'budget' => 12200],
                        ['sale' => 16150, 'budget' => 13500],
                        ['sale' => 12754, 'budget' => 12000],
                        ['sale' => 18107, 'budget' => 18500],
                        ['sale' => 20397, 'budget' => 19000],
                        ['sale' => 17810, 'budget' => 17000],
                        ['sale' => 9943, 'budget' => 10200],
                        ['sale' => 11106, 'budget' => 11000],
                        ['sale' => 14303, 'budget' => 13500],
                        ['sale' => 12447, 'budget' => 12500],
                        ['sale' => 18226, 'budget' => 17400],
                        ['sale' => 20563, 'budget' => 19200],
                        ['sale' => 19482, 'budget' => 17500],
                        ['sale' => 9628, 'budget' => 11000],
                        ['sale' => 10639, 'budget' => 11500],
                        ['sale' => 14402, 'budget' => 13500],
                        ['sale' => 12729, 'budget' => 12000],
                        ['sale' => 19854, 'budget' => 17500],
                        ['sale' => 21230, 'budget' => 20000],
                        ['sale' => 6020, 'budget' => 7800],
                        ['sale' => 0, 'budget' => 0],
                        ['sale' => 17939, 'budget' => 15500],
                        ['sale' => 17407, 'budget' => 16000],
                        ['sale' => 17991, 'budget' => 15000],
                        ['sale' => 19577, 'budget' => 17500],
                        ['sale' => 19950, 'budget' => 17500],
                        ['sale' => 6200, 'budget' => 7600],
                    ]
                ],
                '2018' =>[
                    '01' => [
                        ['sale' => 22150, 'budget' => 19000],
                        ['sale' => 16084, 'budget' => 14500],
                        ['sale' => 17106, 'budget' => 15000],
                        ['sale' => 14958, 'budget' => 14000],
                        ['sale' => 19151, 'budget' => 18000],
                        ['sale' => 18597, 'budget' => 19000],
                        ['sale' => 17703, 'budget' => 16000],
                        ['sale' => 8349, 'budget' => 9200],
                        ['sale' => 11387, 'budget' => 10200],
                        ['sale' => 0, 'budget' => 13500],
                        ['sale' => 0, 'budget' => 10500],
                        ['sale' => 0, 'budget' => 15500],
                        ['sale' => 0, 'budget' => 19500],
                        ['sale' => 0, 'budget' => 15400],
                        ['sale' => 0, 'budget' => 8600],
                        ['sale' => 0, 'budget' => 9200],
                        ['sale' => 0, 'budget' => 12500],
                        ['sale' => 0, 'budget' => 10800],
                        ['sale' => 0, 'budget' => 16800],
                        ['sale' => 0, 'budget' => 20100],
                        ['sale' => 0, 'budget' => 16000],
                        ['sale' => 0, 'budget' => 8900],
                        ['sale' => 0, 'budget' => 9500],
                        ['sale' => 0, 'budget' => 12400],
                        ['sale' => 0, 'budget' => 9400],
                        ['sale' => 0, 'budget' => 15800],
                        ['sale' => 0, 'budget' => 18500],
                        ['sale' => 0, 'budget' => 16200],
                        ['sale' => 0, 'budget' => 8400],
                        ['sale' => 0, 'budget' => 10100],
                        ['sale' => 0, 'budget' => 12500],
                    ]
                ]
            ]
        ];

        foreach($dailySaleListToCreate as $restaurantIdentifier=>$yearsDatas) {
            if ($this->hasReference($restaurantIdentifier)) {
                $restaurant = $this->getReference($restaurantIdentifier);

                foreach($yearsDatas as $year=>$monthsDatas) {
                    foreach($monthsDatas as $month=>$daysDatas) {
                        foreach($daysDatas as $index=>$values) {
                            $datas = [
                                'year' => $year,
                                'month' => $month,
                                'day' => $index + 1,
                                'budget' => 0,
                                'sale' => $values['sale']
                            ];
                            if (!empty($values['budget']))
                                $datas['budget'] = $values['budget'];
                            $this->createDailySaleEntry($restaurant, $datas, $manager);
                        }
                    }
                }
            }
        }
        $manager->clear();
        gc_collect_cycles();
        $this->importFromFile('MH', $manager);
        $manager->clear();
        gc_collect_cycles();
    }

    function getDependencies()
    {
        return [
            RestaurantFixtures::class
        ];
    }

    public function importFromFile($restaurantIdentifier, ObjectManager $manager)
    {
        $filePath = __DIR__.'/csv/'.$restaurantIdentifier.'.csv';
        if (file_exists($filePath)) {
            $restaurant = $this->getReference($restaurantIdentifier);

            ini_set('auto_detect_line_endings',true);
            if (($handle = fopen($filePath, "r")) !== false) {
                while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                    $entryDate = \DateTime::createFromFormat('d/m/y', $data[0]);
                    if ($entryDate) {
                        $datas = [
                            'year' => $entryDate->format('Y'),
                            'month' => $entryDate->format('m'),
                            'day' => $entryDate->format('d'),
                            'budget' => 0,
                            'sale' => (int)$data[1]
                        ];
                        $this->createDailySaleEntry($restaurant, $datas, $manager);
                    }
                }
                fclose($handle);
            }
            ini_set('auto_detect_line_endings',false);
        }
    }

    private function createDailySaleEntry(Restaurant $restaurant, $datas, ObjectManager $manager)
    {
        $dailySale = new DailySale($restaurant);
        $dailySale->setYear($datas['year']);
        $dailySale->setMonth($datas['month']);
        $dailySale->setDay($datas['day']);
        $dailySale->setBudgetAmount($datas['budget']);
        $dailySale->setFoodSaleAmount($datas['sale']);
        $manager->persist($dailySale);
        $manager->flush($dailySale);
    }
}

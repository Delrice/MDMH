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


class DailySaleDRFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface, DependentFixtureInterface
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
            'DR' => [
                '2017' =>[
                    '01' => [
                        ['sale' => 18385, 'budget' => 16200],
                        ['sale' => 11989, 'budget' => 11300],
                        ['sale' => 7894, 'budget' => 9400],
                        ['sale' => 10149, 'budget' => 11100],
                        ['sale' => 9104, 'budget' => 9200],
                        ['sale' => 13522, 'budget' => 12800],
                        ['sale' => 13559, 'budget' => 13900],
                        ['sale' => 12499, 'budget' => 13700],
                        ['sale' => 7952, 'budget' => 7400],
                        ['sale' => 8586, 'budget' => 8500],
                        ['sale' => 11245, 'budget' => 10400],
                        ['sale' => 9333, 'budget' => 8000],
                        ['sale' => 13239, 'budget' => 12900],
                        ['sale' => 13606, 'budget' => 13600],
                        ['sale' => 11694, 'budget' => 13600],
                        ['sale' => 6921, 'budget' => 6600],
                        ['sale' => 8296, 'budget' => 7200],
                        ['sale' => 10034, 'budget' => 9100],
                        ['sale' => 8876, 'budget' => 8100],
                        ['sale' => 13925, 'budget' => 12100],
                        ['sale' => 14709, 'budget' => 13100],
                        ['sale' => 14576, 'budget' => 14100],
                        ['sale' => 7332, 'budget' => 6300],
                        ['sale' => 7495, 'budget' => 8000],
                        ['sale' => 10088, 'budget' => 10200],
                        ['sale' => 7552, 'budget' => 8700],
                        ['sale' => 13221, 'budget' => 13500],
                        ['sale' => 12008, 'budget' => 14100],
                        ['sale' => 13130, 'budget' => 13800],
                        ['sale' => 7225, 'budget' => 7000],
                        ['sale' => 8679, 'budget' => 8200],
                    ],
                    '02' => [
                        ['sale' => 10386, 'budget' => 11200],
                        ['sale' => 8603, 'budget' => 9200],
                        ['sale' => 13261, 'budget' => 14600],
                        ['sale' => 12556, 'budget' => 14300],
                        ['sale' => 13307, 'budget' => 14700],
                        ['sale' => 9515, 'budget' => 8900],
                        ['sale' => 10851, 'budget' => 9200],
                        ['sale' => 11504, 'budget' => 11500],
                        ['sale' => 11312, 'budget' => 11200],
                        ['sale' => 13128, 'budget' => 13800],
                        ['sale' => 12756, 'budget' => 14000],
                        ['sale' => 14472, 'budget' => 13600],
                        ['sale' => 9332, 'budget' => 9200],
                        ['sale' => 10651, 'budget' => 8900],
                        ['sale' => 9788, 'budget' => 11600],
                        ['sale' => 10880, 'budget' => 10700],
                        ['sale' => 13456, 'budget' => 13000],
                        ['sale' => 13517, 'budget' => 12500],
                        ['sale' => 15007, 'budget' => 14600],
                        ['sale' => 7686, 'budget' => 7200],
                        ['sale' => 7595, 'budget' => 8000],
                        ['sale' => 9921, 'budget' => 10000],
                        ['sale' => 8647, 'budget' => 9000],
                        ['sale' => 14226, 'budget' => 14000],
                        ['sale' => 13699, 'budget' => 13000],
                        ['sale' => 14776, 'budget' => 13700],
                        ['sale' => 7603, 'budget' => 7800],
                        ['sale' => 8688, 'budget' => 8900],
                    ],
                    '03' => [
                        ['sale' => 10595, 'budget' => 10700],
                        ['sale' => 10176, 'budget' => 9900],
                        ['sale' => 12995, 'budget' => 13500],
                        ['sale' => 14235, 'budget' => 14500],
                        ['sale' => 14122, 'budget' => 15000],
                        ['sale' => 8143, 'budget' => 7400],
                        ['sale' => 10374, 'budget' => 8400],
                        ['sale' => 11713, 'budget' => 10300],
                        ['sale' => 8949, 'budget' => 9300],
                        ['sale' => 14323, 'budget' => 13800],
                        ['sale' => 14130, 'budget' => 13200],
                        ['sale' => 15591, 'budget' => 14500],
                        ['sale' => 7340, 'budget' => 8000],
                        ['sale' => 7926, 'budget' => 8200],
                        ['sale' => 11320, 'budget' => 10000],
                        ['sale' => 8289, 'budget' => 8800],
                        ['sale' => 12927, 'budget' => 13600],
                        ['sale' => 12848, 'budget' => 13400],
                        ['sale' => 13952, 'budget' => 14100],
                        ['sale' => 7044, 'budget' => 6800],
                        ['sale' => 7344, 'budget' => 7100],
                        ['sale' => 9628, 'budget' => 10200],
                        ['sale' => 8695, 'budget' => 8200],
                        ['sale' => 12492, 'budget' => 13300],
                        ['sale' => 12391, 'budget' => 14400],
                        ['sale' => 15250, 'budget' => 15000],
                        ['sale' => 6918, 'budget' => 7200],
                        ['sale' => 7716, 'budget' => 8300],
                        ['sale' => 10498, 'budget' => 11000],
                        ['sale' => 8562, 'budget' => 9800],
                        ['sale' => 13798, 'budget' => 13500],
                    ],
                    '04' => [
                        ['sale' => 13194, 'budget' => 13500],
                        ['sale' => 14250, 'budget' => 15100],
                        ['sale' => 9897, 'budget' => 9700],
                        ['sale' => 9951, 'budget' => 9500],
                        ['sale' => 11474, 'budget' => 11200],
                        ['sale' => 11658, 'budget' => 10500],
                        ['sale' => 14984, 'budget' => 14500],
                        ['sale' => 11843, 'budget' => 12500],
                        ['sale' => 16609, 'budget' => 15000],
                        ['sale' => 10612, 'budget' => 9300],
                        ['sale' => 10847, 'budget' => 9200],
                        ['sale' => 11365, 'budget' => 11500],
                        ['sale' => 11113, 'budget' => 10300],
                        ['sale' => 13695, 'budget' => 14200],
                        ['sale' => 12390, 'budget' => 12500],
                        ['sale' => 11721, 'budget' => 12000],
                        ['sale' => 14076, 'budget' => 13600],
                        ['sale' => 8659, 'budget' => 9000],
                        ['sale' => 10981, 'budget' => 10400],
                        ['sale' => 9639, 'budget' => 8500],
                        ['sale' => 13835, 'budget' => 13400],
                        ['sale' => 13833, 'budget' => 12800],
                        ['sale' => 16550, 'budget' => 14800],
                        ['sale' => 8244, 'budget' => 7500],
                        ['sale' => 7135, 'budget' => 8500],
                        ['sale' => 11040, 'budget' => 11200],
                        ['sale' => 10059, 'budget' => 9300],
                        ['sale' => 14624, 'budget' => 14000],
                        ['sale' => 14864, 'budget' => 12500],
                        ['sale' => 16499, 'budget' => 13700],
                    ],
                    '05' => [
                        ['sale' => 16276, 'budget' => 15000],
                        ['sale' => 8829, 'budget' => 10000],
                        ['sale' => 10885, 'budget' => 11300],
                        ['sale' => 9361, 'budget' => 9800],
                        ['sale' => 15562, 'budget' => 14100],
                        ['sale' => 14490, 'budget' => 12700],
                        ['sale' => 15746, 'budget' => 14000],
                        ['sale' => 15222, 'budget' => 15000],
                        ['sale' => 8077, 'budget' => 9200],
                        ['sale' => 10464, 'budget' => 10400],
                        ['sale' => 10020, 'budget' => 9700],
                        ['sale' => 13845, 'budget' => 13500],
                        ['sale' => 13487, 'budget' => 12500],
                        ['sale' => 15415, 'budget' => 13800],
                        ['sale' => 7574, 'budget' => 7800],
                        ['sale' => 8530, 'budget' => 8600],
                        ['sale' => 9972, 'budget' => 10400],
                        ['sale' => 8728, 'budget' => 9000],
                        ['sale' => 12840, 'budget' => 13000],
                        ['sale' => 12530, 'budget' => 12200],
                        ['sale' => 13507, 'budget' => 13400],
                        ['sale' => 8439, 'budget' => 8000],
                        ['sale' => 8838, 'budget' => 9200],
                        ['sale' => 13635, 'budget' => 13500],
                        ['sale' => 12819, 'budget' => 14100],
                        ['sale' => 12701, 'budget' => 13200],
                        ['sale' => 10941, 'budget' => 13400],
                        ['sale' => 15463, 'budget' => 17000],
                        ['sale' => 7323, 'budget' => 8300],
                        ['sale' => 8598, 'budget' => 9400],
                        ['sale' => 10616, 'budget' => 11200],
                    ],
                    '06' => [
                        ['sale' => 9707, 'budget' => 9600],
                        ['sale' => 14113, 'budget' => 14500],
                        ['sale' => 12707, 'budget' => 12500],
                        ['sale' => 11921, 'budget' => 12000],
                        ['sale' => 13617, 'budget' => 15000],
                        ['sale' => 9493, 'budget' => 9400],
                        ['sale' => 11724, 'budget' => 10800],
                        ['sale' => 9719, 'budget' => 10000],
                        ['sale' => 12619, 'budget' => 13000],
                        ['sale' => 11841, 'budget' => 12400],
                        ['sale' => 14726, 'budget' => 15300],
                        ['sale' => 9928, 'budget' => 7900],
                        ['sale' => 8855, 'budget' => 8200],
                        ['sale' => 11727, 'budget' => 10700],
                        ['sale' => 11055, 'budget' => 9800],
                        ['sale' => 14214, 'budget' => 12800],
                        ['sale' => 11501, 'budget' => 11500],
                        ['sale' => 15035, 'budget' => 13200],
                        ['sale' => 8509, 'budget' => 8400],
                        ['sale' => 8834, 'budget' => 9000],
                        ['sale' => 10710, 'budget' => 10000],
                        ['sale' => 10291, 'budget' => 9900],
                        ['sale' => 13849, 'budget' => 13500],
                        ['sale' => 12656, 'budget' => 11200],
                        ['sale' => 14645, 'budget' => 13900],
                        ['sale' => 10310, 'budget' => 9000],
                        ['sale' => 9932, 'budget' => 9700],
                        ['sale' => 12866, 'budget' => 10600],
                        ['sale' => 10207, 'budget' => 11000],
                        ['sale' => 16235, 'budget' => 12800],
                    ],
                    '07' => [
                        ['sale' => 13805, 'budget' => 11200],
                        ['sale' => 15062, 'budget' => 13600],
                        ['sale' => 10604, 'budget' => 10200],
                        ['sale' => 11543, 'budget' => 10800],
                        ['sale' => 13290, 'budget' => 12500],
                        ['sale' => 11883, 'budget' => 11000],
                        ['sale' => 14260, 'budget' => 13500],
                        ['sale' => 13265, 'budget' => 11600],
                        ['sale' => 17048, 'budget' => 14100],
                        ['sale' => 11552, 'budget' => 12100],
                        ['sale' => 10568, 'budget' => 11800],
                        ['sale' => 11592, 'budget' => 11500],
                        ['sale' => 12959, 'budget' => 13000],
                        ['sale' => 13262, 'budget' => 14000],
                        ['sale' => 11881, 'budget' => 12000],
                        ['sale' => 16090, 'budget' => 15200],
                        ['sale' => 10434, 'budget' => 10900],
                        ['sale' => 9914, 'budget' => 10600],
                        ['sale' => 10854, 'budget' => 11300],
                        ['sale' => 10571, 'budget' => 11200],
                        ['sale' => 14186, 'budget' => 14800],
                        ['sale' => 11809, 'budget' => 13200],
                        ['sale' => 14618, 'budget' => 14000],
                        ['sale' => 11244, 'budget' => 11000],
                        ['sale' => 10075, 'budget' => 10600],
                        ['sale' => 11841, 'budget' => 11500],
                        ['sale' => 12568, 'budget' => 11800],
                        ['sale' => 14723, 'budget' => 13500],
                        ['sale' => 13284, 'budget' => 14200],
                        ['sale' => 17142, 'budget' => 15700],
                        ['sale' => 11871, 'budget' => 12700],
                    ],
                    '08' => [
                        ['sale' => 12358, 'budget' => 12000],
                        ['sale' => 12462, 'budget' => 13000],
                        ['sale' => 11617, 'budget' => 12200],
                        ['sale' => 16100, 'budget' => 15500],
                        ['sale' => 15600, 'budget' => 16000],
                        ['sale' => 16667, 'budget' => 16800],
                        ['sale' => 15145, 'budget' => 13500],
                        ['sale' => 13860, 'budget' => 12800],
                        ['sale' => 13782, 'budget' => 12500],
                        ['sale' => 14148, 'budget' => 12500],
                        ['sale' => 15626, 'budget' => 15000],
                        ['sale' => 14004, 'budget' => 14000],
                        ['sale' => 16447, 'budget' => 15000],
                        ['sale' => 13419, 'budget' => 13000],
                        ['sale' => 15887, 'budget' => 14500],
                        ['sale' => 13452, 'budget' => 12900],
                        ['sale' => 13156, 'budget' => 12500],
                        ['sale' => 16111, 'budget' => 14000],
                        ['sale' => 15374, 'budget' => 15400],
                        ['sale' => 17183, 'budget' => 16200],
                        ['sale' => 12805, 'budget' => 12100],
                        ['sale' => 12320, 'budget' => 11400],
                        ['sale' => 11656, 'budget' => 11500],
                        ['sale' => 13640, 'budget' => 11500],
                        ['sale' => 14044, 'budget' => 13500],
                        ['sale' => 13465, 'budget' => 13200],
                        ['sale' => 15495, 'budget' => 16400],
                        ['sale' => 12033, 'budget' => 11600],
                        ['sale' => 12193, 'budget' => 11200],
                        ['sale' => 12366, 'budget' => 12500],
                        ['sale' => 12526, 'budget' => 11400],
                    ],
                    '09' => [
                        ['sale' => 14439, 'budget' => 14000],
                        ['sale' => 12722, 'budget' => 12500],
                        ['sale' => 16563, 'budget' => 15500],
                        ['sale' => 10171, 'budget' => 8500],
                        ['sale' => 11288, 'budget' => 9400],
                        ['sale' => 12910, 'budget' => 11600],
                        ['sale' => 8627, 'budget' => 9400],
                        ['sale' => 13930, 'budget' => 14000],
                        ['sale' => 14333, 'budget' => 12600],
                        ['sale' => 15545, 'budget' => 15600],
                        ['sale' => 7565, 'budget' => 8800],
                        ['sale' => 9085, 'budget' => 8900],
                        ['sale' => 10893, 'budget' => 10000],
                        ['sale' => 8867, 'budget' => 9400],
                        ['sale' => 14413, 'budget' => 13800],
                        ['sale' => 13940, 'budget' => 13100],
                        ['sale' => 14002, 'budget' => 14500],
                        ['sale' => 7903, 'budget' => 8000],
                        ['sale' => 7892, 'budget' => 8200],
                        ['sale' => 11344, 'budget' => 10700],
                        ['sale' => 9440, 'budget' => 8700],
                        ['sale' => 13867, 'budget' => 13500],
                        ['sale' => 13446, 'budget' => 13400],
                        ['sale' => 15302, 'budget' => 15200],
                        ['sale' => 7703, 'budget' => 7300],
                        ['sale' => 7702, 'budget' => 8000],
                        ['sale' => 10485, 'budget' => 10800],
                        ['sale' => 9911, 'budget' => 9600],
                        ['sale' => 13994, 'budget' => 15000],
                        ['sale' => 13322, 'budget' => 13300],
                    ],
                    '10' => [
                        ['sale' => 16975, 'budget' => 14600],
                        ['sale' => 9032, 'budget' => 8400],
                        ['sale' => 9243, 'budget' => 9800],
                        ['sale' => 11713, 'budget' => 12000],
                        ['sale' => 10137, 'budget' => 10500],
                        ['sale' => 15586, 'budget' => 14500],
                        ['sale' => 15724, 'budget' => 14800],
                        ['sale' => 15267, 'budget' => 15500],
                        ['sale' => 8428, 'budget' => 7500],
                        ['sale' => 10788, 'budget' => 8700],
                        ['sale' => 10229, 'budget' => 10500],
                        ['sale' => 9320, 'budget' => 9000],
                        ['sale' => 14587, 'budget' => 14200],
                        ['sale' => 14890, 'budget' => 13500],
                        ['sale' => 16679, 'budget' => 14500],
                        ['sale' => 8209, 'budget' => 7600],
                        ['sale' => 8403, 'budget' => 8000],
                        ['sale' => 10471, 'budget' => 11200],
                        ['sale' => 9468, 'budget' => 9500],
                        ['sale' => 15070, 'budget' => 14000],
                        ['sale' => 14804, 'budget' => 13000],
                        ['sale' => 14763, 'budget' => 14500],
                        ['sale' => 9696, 'budget' => 10400],
                        ['sale' => 10001, 'budget' => 10800],
                        ['sale' => 11876, 'budget' => 12000],
                        ['sale' => 10825, 'budget' => 12400],
                        ['sale' => 14555, 'budget' => 15500],
                        ['sale' => 14183, 'budget' => 14400],
                        ['sale' => 15632, 'budget' => 15600],
                        ['sale' => 11330, 'budget' => 10500],
                        ['sale' => 14221, 'budget' => 12500],
                    ],
                    '11' => [
                        ['sale' => 14982, 'budget' => 14500],
                        ['sale' => 11817, 'budget' => 12500],
                        ['sale' => 14274, 'budget' => 14500],
                        ['sale' => 11935, 'budget' => 15400],
                        ['sale' => 15117, 'budget' => 14700],
                        ['sale' => 9006, 'budget' => 7800],
                        ['sale' => 10019, 'budget' => 8300],
                        ['sale' => 12045, 'budget' => 10400],
                        ['sale' => 10158, 'budget' => 9200],
                        ['sale' => 14225, 'budget' => 13800],
                        ['sale' => 15723, 'budget' => 14000],
                        ['sale' => 16251, 'budget' => 13700],
                        ['sale' => 8510, 'budget' => 7700],
                        ['sale' => 9506, 'budget' => 8000],
                        ['sale' => 10645, 'budget' => 10400],
                        ['sale' => 8789, 'budget' => 8900],
                        ['sale' => 13820, 'budget' => 12900],
                        ['sale' => 14052, 'budget' => 13100],
                        ['sale' => 15283, 'budget' => 13800],
                        ['sale' => 7943, 'budget' => 7200],
                        ['sale' => 7919, 'budget' => 8600],
                        ['sale' => 9301, 'budget' => 10800],
                        ['sale' => 8439, 'budget' => 9600],
                        ['sale' => 13222, 'budget' => 13000],
                        ['sale' => 13962, 'budget' => 13500],
                        ['sale' => 13463, 'budget' => 13800],
                        ['sale' => 7392, 'budget' => 7500],
                        ['sale' => 8332, 'budget' => 8900],
                        ['sale' => 11343, 'budget' => 10800],
                        ['sale' => 9127, 'budget' => 9500],
                    ],
                    '12' => [
                        ['sale' => 13437, 'budget' => 14300],
                        ['sale' => 13624, 'budget' => 16200],
                        ['sale' => 15904, 'budget' => 15800],
                        ['sale' => 8792, 'budget' => 8500],
                        ['sale' => 11584, 'budget' => 9200],
                        ['sale' => 13758, 'budget' => 12100],
                        ['sale' => 10562, 'budget' => 10000],
                        ['sale' => 15858, 'budget' => 14200],
                        ['sale' => 15856, 'budget' => 14500],
                        ['sale' => 15159, 'budget' => 13800],
                        ['sale' => 8592, 'budget' => 7600],
                        ['sale' => 9689, 'budget' => 9000],
                        ['sale' => 12647, 'budget' => 11600],
                        ['sale' => 10098, 'budget' => 10000],
                        ['sale' => 15050, 'budget' => 14700],
                        ['sale' => 15180, 'budget' => 15000],
                        ['sale' => 14786, 'budget' => 13500],
                        ['sale' => 8986, 'budget' => 7600],
                        ['sale' => 10116, 'budget' => 8900],
                        ['sale' => 12310, 'budget' => 12000],
                        ['sale' => 11919, 'budget' => 10700],
                        ['sale' => 16308, 'budget' => 14800],
                        ['sale' => 16898, 'budget' => 15400],
                        ['sale' => 4928, 'budget' => 5600],
                        ['sale' => 0, 'budget' => 0],
                        ['sale' => 12859, 'budget' => 12600],
                        ['sale' => 13332, 'budget' => 12300],
                        ['sale' => 13735, 'budget' => 12000],
                        ['sale' => 15441, 'budget' => 14700],
                        ['sale' => 14380, 'budget' => 15500],
                        ['sale' => 5757, 'budget' => 5400],
                    ]
                ],
                '2018' =>[
                    '01' => [
                        ['sale' => 18456, 'budget' => 16121],
                        ['sale' => 12813, 'budget' => 8121],
                        ['sale' => 13503, 'budget' => 11621],
                        ['sale' => 12789, 'budget' => 10121],
                        ['sale' => 15981, 'budget' => 14621],
                        ['sale' => 13520, 'budget' => 14121],
                        ['sale' => 14504, 'budget' => 14121],
                        ['sale' => 7355, 'budget' => 8121],
                        ['sale' => 9237, 'budget' => 8721],
                        ['sale' => 10738, 'budget' => 11121],
                        ['sale' => 9059, 'budget' => 8621],
                        ['sale' => 14758, 'budget' => 13121],
                        ['sale' => 13806, 'budget' => 13821],
                        ['sale' => 13290, 'budget' => 13621],
                        ['sale' => 7547, 'budget' => 7121],
                        ['sale' => 8301, 'budget' => 8341],
                        ['sale' => 0, 'budget' => 10541],
                        ['sale' => 0, 'budget' => 8941],
                        ['sale' => 0, 'budget' => 14041],
                        ['sale' => 0, 'budget' => 15041],
                        ['sale' => 0, 'budget' => 14641],
                        ['sale' => 0, 'budget' => 7541],
                        ['sale' => 0, 'budget' => 7941],
                        ['sale' => 0, 'budget' => 10141],
                        ['sale' => 0, 'budget' => 8541],
                        ['sale' => 0, 'budget' => 13541],
                        ['sale' => 0, 'budget' => 13041],
                        ['sale' => 0, 'budget' => 13741],
                        ['sale' => 0, 'budget' => 7041],
                        ['sale' => 0, 'budget' => 8341],
                        ['sale' => 0, 'budget' => 11041],
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
        $this->importFromFile('DR', $manager);
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

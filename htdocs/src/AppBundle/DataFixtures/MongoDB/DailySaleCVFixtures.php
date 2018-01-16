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


class DailySaleCVFixtures extends Fixture implements FixtureInterface, ContainerAwareInterface, DependentFixtureInterface
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
            'CV' => [
                '2017' =>[
                    '01' => [
                        ['sale' => 7684, 'budget' => 7900],
                        ['sale' => 5618, 'budget' => 5500],
                        ['sale' => 5372, 'budget' => 6900],
                        ['sale' => 5808, 'budget' => 8100],
                        ['sale' => 6484, 'budget' => 6070],
                        ['sale' => 9364, 'budget' => 8100],
                        ['sale' => 7479, 'budget' => 8200],
                        ['sale' => 6998, 'budget' => 6800],
                        ['sale' => 4947, 'budget' => 5900],
                        ['sale' => 5224, 'budget' => 5400],
                        ['sale' => 7138, 'budget' => 6900],
                        ['sale' => 4939, 'budget' => 6200],
                        ['sale' => 7295, 'budget' => 8500],
                        ['sale' => 7576, 'budget' => 8100],
                        ['sale' => 5816, 'budget' => 7300],
                        ['sale' => 4386, 'budget' => 5700],
                        ['sale' => 5153, 'budget' => 5300],
                        ['sale' => 5828, 'budget' => 6200],
                        ['sale' => 5279, 'budget' => 5400],
                        ['sale' => 8450, 'budget' => 7900],
                        ['sale' => 8809, 'budget' => 8500],
                        ['sale' => 6460, 'budget' => 7100],
                        ['sale' => 4401, 'budget' => 4950],
                        ['sale' => 4905, 'budget' => 5350],
                        ['sale' => 6298, 'budget' => 6600],
                        ['sale' => 4682, 'budget' => 5900],
                        ['sale' => 6726, 'budget' => 7900],
                        ['sale' => 7558, 'budget' => 7850],
                        ['sale' => 6687, 'budget' => 7400],
                        ['sale' => 4446, 'budget' => 4900],
                        ['sale' => 5194, 'budget' => 5500],
                    ],
                    '02' => [
                        ['sale' => 6247, 'budget' => 6950],
                        ['sale' => 5365, 'budget' => 6900],
                        ['sale' => 8402, 'budget' => 9000],
                        ['sale' => 7262, 'budget' => 7700],
                        ['sale' => 6940, 'budget' => 7200],
                        ['sale' => 6191, 'budget' => 5900],
                        ['sale' => 7359, 'budget' => 5800],
                        ['sale' => 7679, 'budget' => 6700],
                        ['sale' => 7340, 'budget' => 5700],
                        ['sale' => 7689, 'budget' => 7900],
                        ['sale' => 7067, 'budget' => 7300],
                        ['sale' => 7884, 'budget' => 6800],
                        ['sale' => 6428, 'budget' => 6000],
                        ['sale' => 7839, 'budget' => 5400],
                        ['sale' => 6470, 'budget' => 6400],
                        ['sale' => 6373, 'budget' => 5750],
                        ['sale' => 7552, 'budget' => 7900],
                        ['sale' => 6835, 'budget' => 6700],
                        ['sale' => 7495, 'budget' => 6900],
                        ['sale' => 5100, 'budget' => 4700],
                        ['sale' => 5264, 'budget' => 5500],
                        ['sale' => 6091, 'budget' => 6500],
                        ['sale' => 5365, 'budget' => 6200],
                        ['sale' => 8340, 'budget' => 7700],
                        ['sale' => 7910, 'budget' => 7500],
                        ['sale' => 7496, 'budget' => 6900],
                        ['sale' => 4509, 'budget' => 6000],
                        ['sale' => 5913, 'budget' => 5800],
                    ],
                    '03' => [
                        ['sale' => 6962, 'budget' => 6750],
                        ['sale' => 5907, 'budget' => 6200],
                        ['sale' => 9220, 'budget' => 8800],
                        ['sale' => 8284, 'budget' => 8550],
                        ['sale' => 6657, 'budget' => 7500],
                        ['sale' => 5670, 'budget' => 5500],
                        ['sale' => 6544, 'budget' => 5600],
                        ['sale' => 7591, 'budget' => 6850],
                        ['sale' => 6220, 'budget' => 5800],
                        ['sale' => 9439, 'budget' => 8950],
                        ['sale' => 7815, 'budget' => 7850],
                        ['sale' => 7677, 'budget' => 7500],
                        ['sale' => 4654, 'budget' => 5100],
                        ['sale' => 5131, 'budget' => 5200],
                        ['sale' => 6210, 'budget' => 6600],
                        ['sale' => 5945, 'budget' => 5100],
                        ['sale' => 8019, 'budget' => 8100],
                        ['sale' => 7053, 'budget' => 8000],
                        ['sale' => 6632, 'budget' => 7450],
                        ['sale' => 4823, 'budget' => 5350],
                        ['sale' => 5147, 'budget' => 5050],
                        ['sale' => 5766, 'budget' => 6200],
                        ['sale' => 2906, 'budget' => 5600],
                        ['sale' => 8138, 'budget' => 8050],
                        ['sale' => 7527, 'budget' => 6850],
                        ['sale' => 6084, 'budget' => 6500],
                        ['sale' => 4390, 'budget' => 5850],
                        ['sale' => 5016, 'budget' => 5600],
                        ['sale' => 6210, 'budget' => 6800],
                        ['sale' => 5497, 'budget' => 5500],
                        ['sale' => 8824, 'budget' => 7800],
                    ],
                    '04' => [
                        ['sale' => 6463, 'budget' => 7500],
                        ['sale' => 6790, 'budget' => 6950],
                        ['sale' => 6057, 'budget' => 6350],
                        ['sale' => 5937, 'budget' => 6050],
                        ['sale' => 6652, 'budget' => 6050],
                        ['sale' => 6915, 'budget' => 6480],
                        ['sale' => 8139, 'budget' => 8300],
                        ['sale' => 7272, 'budget' => 7950],
                        ['sale' => 8302, 'budget' => 7050],
                        ['sale' => 6455, 'budget' => 6500],
                        ['sale' => 5595, 'budget' => 6380],
                        ['sale' => 6647, 'budget' => 5900],
                        ['sale' => 6802, 'budget' => 6100],
                        ['sale' => 7288, 'budget' => 7500],
                        ['sale' => 5849, 'budget' => 7000],
                        ['sale' => 5756, 'budget' => 6850],
                        ['sale' => 6679, 'budget' => 6500],
                        ['sale' => 5621, 'budget' => 5500],
                        ['sale' => 6451, 'budget' => 6850],
                        ['sale' => 6229, 'budget' => 5850],
                        ['sale' => 8288, 'budget' => 7850],
                        ['sale' => 7992, 'budget' => 7800],
                        ['sale' => 6782, 'budget' => 7380],
                        ['sale' => 4695, 'budget' => 5800],
                        ['sale' => 5468, 'budget' => 5300],
                        ['sale' => 5992, 'budget' => 6880],
                        ['sale' => 5606, 'budget' => 5930],
                        ['sale' => 8703, 'budget' => 7980],
                        ['sale' => 6840, 'budget' => 6630],
                        ['sale' => 7607, 'budget' => 7500],
                    ],
                    '05' => [
                        ['sale' => 7267, 'budget' => 7700],
                        ['sale' => 4746, 'budget' => 5750],
                        ['sale' => 6092, 'budget' => 6800],
                        ['sale' => 5797, 'budget' => 6100],
                        ['sale' => 9473, 'budget' => 7850],
                        ['sale' => 8289, 'budget' => 7750],
                        ['sale' => 7529, 'budget' => 6100],
                        ['sale' => 7249, 'budget' => 7550],
                        ['sale' => 5506, 'budget' => 5500],
                        ['sale' => 6271, 'budget' => 7350],
                        ['sale' => 5444, 'budget' => 6250],
                        ['sale' => 8392, 'budget' => 7950],
                        ['sale' => 7077, 'budget' => 7850],
                        ['sale' => 6960, 'budget' => 6550],
                        ['sale' => 5486, 'budget' => 5300],
                        ['sale' => 5683, 'budget' => 5300],
                        ['sale' => 6020, 'budget' => 6800],
                        ['sale' => 5639, 'budget' => 6100],
                        ['sale' => 7335, 'budget' => 7950],
                        ['sale' => 5692, 'budget' => 6500],
                        ['sale' => 5962, 'budget' => 6850],
                        ['sale' => 4901, 'budget' => 6200],
                        ['sale' => 5707, 'budget' => 6350],
                        ['sale' => 8076, 'budget' => 6100],
                        ['sale' => 8904, 'budget' => 8250],
                        ['sale' => 8557, 'budget' => 9000],
                        ['sale' => 7206, 'budget' => 9000],
                        ['sale' => 6185, 'budget' => 8500],
                        ['sale' => 4231, 'budget' => 4950],
                        ['sale' => 5181, 'budget' => 6110],
                        ['sale' => 5608, 'budget' => 6800],
                    ],
                    '06' => [
                        ['sale' => 5525, 'budget' => 6150],
                        ['sale' => 7937, 'budget' => 8100],
                        ['sale' => 6504, 'budget' => 7650],
                        ['sale' => 5525, 'budget' => 7500],
                        ['sale' => 6178, 'budget' => 5300],
                        ['sale' => 5278, 'budget' => 6450],
                        ['sale' => 7638, 'budget' => 6500],
                        ['sale' => 5666, 'budget' => 5950],
                        ['sale' => 8213, 'budget' => 8100],
                        ['sale' => 5886, 'budget' => 6750],
                        ['sale' => 6606, 'budget' => 6800],
                        ['sale' => 4369, 'budget' => 4950],
                        ['sale' => 4769, 'budget' => 5300],
                        ['sale' => 5592, 'budget' => 6900],
                        ['sale' => 5844, 'budget' => 5400],
                        ['sale' => 7995, 'budget' => 7900],
                        ['sale' => 5792, 'budget' => 6750],
                        ['sale' => 6471, 'budget' => 6350],
                        ['sale' => 4926, 'budget' => 5350],
                        ['sale' => 5048, 'budget' => 5700],
                        ['sale' => 6375, 'budget' => 6350],
                        ['sale' => 5269, 'budget' => 5850],
                        ['sale' => 7352, 'budget' => 7050],
                        ['sale' => 5707, 'budget' => 6500],
                        ['sale' => 7905, 'budget' => 6650],
                        ['sale' => 6819, 'budget' => 5100],
                        ['sale' => 6076, 'budget' => 5600],
                        ['sale' => 6895, 'budget' => 6650],
                        ['sale' => 6087, 'budget' => 5900],
                        ['sale' => 8634, 'budget' => 7650],
                    ],
                    '07' => [
                        ['sale' => 6308, 'budget' => 6550],
                        ['sale' => 7094, 'budget' => 6500],
                        ['sale' => 6659, 'budget' => 5700],
                        ['sale' => 6281, 'budget' => 6850],
                        ['sale' => 8267, 'budget' => 6850],
                        ['sale' => 8041, 'budget' => 6900],
                        ['sale' => 8322, 'budget' => 8100],
                        ['sale' => 8218, 'budget' => 6100],
                        ['sale' => 7687, 'budget' => 7000],
                        ['sale' => 6942, 'budget' => 6500],
                        ['sale' => 6973, 'budget' => 7500],
                        ['sale' => 6847, 'budget' => 6900],
                        ['sale' => 6208, 'budget' => 7100],
                        ['sale' => 6369, 'budget' => 7300],
                        ['sale' => 6259, 'budget' => 6100],
                        ['sale' => 7124, 'budget' => 7400],
                        ['sale' => 6567, 'budget' => 6100],
                        ['sale' => 5680, 'budget' => 5500],
                        ['sale' => 6024, 'budget' => 7500],
                        ['sale' => 5757, 'budget' => 6000],
                        ['sale' => 6857, 'budget' => 7500],
                        ['sale' => 7169, 'budget' => 6700],
                        ['sale' => 6636, 'budget' => 7800],
                        ['sale' => 6595, 'budget' => 6900],
                        ['sale' => 6232, 'budget' => 6400],
                        ['sale' => 6495, 'budget' => 7000],
                        ['sale' => 6580, 'budget' => 5900],
                        ['sale' => 8436, 'budget' => 6950],
                        ['sale' => 6842, 'budget' => 7300],
                        ['sale' => 8048, 'budget' => 7000],
                        ['sale' => 6667, 'budget' => 6850],
                    ],
                    '08' => [
                        ['sale' => 6098, 'budget' => 7200],
                        ['sale' => 7478, 'budget' => 7800],
                        ['sale' => 7190, 'budget' => 7500],
                        ['sale' => 8503, 'budget' => 8800],
                        ['sale' => 9602, 'budget' => 8900],
                        ['sale' => 8779, 'budget' => 9300],
                        ['sale' => 8131, 'budget' => 7900],
                        ['sale' => 8296, 'budget' => 7200],
                        ['sale' => 8199, 'budget' => 7700],
                        ['sale' => 7954, 'budget' => 7200],
                        ['sale' => 9049, 'budget' => 7900],
                        ['sale' => 8622, 'budget' => 7250],
                        ['sale' => 8272, 'budget' => 7100],
                        ['sale' => 8001, 'budget' => 8300],
                        ['sale' => 8511, 'budget' => 6600],
                        ['sale' => 8225, 'budget' => 7400],
                        ['sale' => 7216, 'budget' => 7600],
                        ['sale' => 8272, 'budget' => 7100],
                        ['sale' => 7550, 'budget' => 8500],
                        ['sale' => 8489, 'budget' => 7700],
                        ['sale' => 7430, 'budget' => 7200],
                        ['sale' => 7054, 'budget' => 6100],
                        ['sale' => 6912, 'budget' => 7700],
                        ['sale' => 8608, 'budget' => 6800],
                        ['sale' => 6826, 'budget' => 7400],
                        ['sale' => 6320, 'budget' => 6500],
                        ['sale' => 7982, 'budget' => 8400],
                        ['sale' => 6512, 'budget' => 7200],
                        ['sale' => 6921, 'budget' => 8100],
                        ['sale' => 7137, 'budget' => 7400],
                        ['sale' => 6953, 'budget' => 6600],
                    ],
                    '09' => [
                        ['sale' => 8908, 'budget' => 9200],
                        ['sale' => 6830, 'budget' => 7100],
                        ['sale' => 7418, 'budget' => 7400],
                        ['sale' => 6970, 'budget' => 6900],
                        ['sale' => 7713, 'budget' => 7300],
                        ['sale' => 8545, 'budget' => 8100],
                        ['sale' => 6879, 'budget' => 6400],
                        ['sale' => 8658, 'budget' => 9400],
                        ['sale' => 8133, 'budget' => 7400],
                        ['sale' => 7662, 'budget' => 7500],
                        ['sale' => 6053, 'budget' => 6100],
                        ['sale' => 5901, 'budget' => 5900],
                        ['sale' => 7555, 'budget' => 6300],
                        ['sale' => 5887, 'budget' => 6100],
                        ['sale' => 9235, 'budget' => 9000],
                        ['sale' => 7212, 'budget' => 7700],
                        ['sale' => 6736, 'budget' => 7700],
                        ['sale' => 4948, 'budget' => 5100],
                        ['sale' => 5630, 'budget' => 5100],
                        ['sale' => 6693, 'budget' => 6500],
                        ['sale' => 5347, 'budget' => 5700],
                        ['sale' => 8080, 'budget' => 8300],
                        ['sale' => 8495, 'budget' => 7350],
                        ['sale' => 6871, 'budget' => 7000],
                        ['sale' => 5912, 'budget' => 4400],
                        ['sale' => 5734, 'budget' => 5100],
                        ['sale' => 6671, 'budget' => 6100],
                        ['sale' => 5289, 'budget' => 5700],
                        ['sale' => 9181, 'budget' => 7800],
                        ['sale' => 8478, 'budget' => 6500],
                    ],
                    '10' => [
                        ['sale' => 7453, 'budget' => 7300],
                        ['sale' => 5704, 'budget' => 5100],
                        ['sale' => 6177, 'budget' => 5300],
                        ['sale' => 7488, 'budget' => 7800],
                        ['sale' => 6892, 'budget' => 5900],
                        ['sale' => 10432, 'budget' => 5900],
                        ['sale' => 8971, 'budget' => 9000],
                        ['sale' => 7898, 'budget' => 5800],
                        ['sale' => 5770, 'budget' => 5000],
                        ['sale' => 7227, 'budget' => 5700],
                        ['sale' => 6731, 'budget' => 6500],
                        ['sale' => 6293, 'budget' => 5000],
                        ['sale' => 10312, 'budget' => 7500],
                        ['sale' => 8485, 'budget' => 8200],
                        ['sale' => 7081, 'budget' => 6700],
                        ['sale' => 5234, 'budget' => 5000],
                        ['sale' => 6364, 'budget' => 5500],
                        ['sale' => 6290, 'budget' => 7500],
                        ['sale' => 6157, 'budget' => 6100],
                        ['sale' => 9320, 'budget' => 7950],
                        ['sale' => 8028, 'budget' => 7100],
                        ['sale' => 8101, 'budget' => 7100],
                        ['sale' => 5991, 'budget' => 5800],
                        ['sale' => 6554, 'budget' => 6700],
                        ['sale' => 6483, 'budget' => 5800],
                        ['sale' => 6914, 'budget' => 7400],
                        ['sale' => 7964, 'budget' => 7700],
                        ['sale' => 7418, 'budget' => 6900],
                        ['sale' => 7391, 'budget' => 7100],
                        ['sale' => 5756, 'budget' => 7700],
                        ['sale' => 7775, 'budget' => 6800],
                    ],
                    '11' => [
                        ['sale' => 8018, 'budget' => 6700],
                        ['sale' => 7272, 'budget' => 5600],
                        ['sale' => 8460, 'budget' => 8300],
                        ['sale' => 6623, 'budget' => 8100],
                        ['sale' => 7560, 'budget' => 7500],
                        ['sale' => 7024, 'budget' => 5950],
                        ['sale' => 7437, 'budget' => 6150],
                        ['sale' => 7300, 'budget' => 7050],
                        ['sale' => 7015, 'budget' => 6750],
                        ['sale' => 9993, 'budget' => 8150],
                        ['sale' => 8208, 'budget' => 7750],
                        ['sale' => 7618, 'budget' => 7050],
                        ['sale' => 5453, 'budget' => 5450],
                        ['sale' => 6311, 'budget' => 6050],
                        ['sale' => 7076, 'budget' => 6250],
                        ['sale' => 6149, 'budget' => 5550],
                        ['sale' => 9128, 'budget' => 8050],
                        ['sale' => 7323, 'budget' => 7350],
                        ['sale' => 6762, 'budget' => 6750],
                        ['sale' => 4595, 'budget' => 5500],
                        ['sale' => 5267, 'budget' => 5600],
                        ['sale' => 6481, 'budget' => 6750],
                        ['sale' => 6119, 'budget' => 6050],
                        ['sale' => 8713, 'budget' => 8050],
                        ['sale' => 7873, 'budget' => 7000],
                        ['sale' => 6500, 'budget' => 6950],
                        ['sale' => 4583, 'budget' => 5300],
                        ['sale' => 5016, 'budget' => 5600],
                        ['sale' => 6529, 'budget' => 7000],
                        ['sale' => 6473, 'budget' => 5700],
                    ],
                    '12' => [
                        ['sale' => 8956, 'budget' => 8200],
                        ['sale' => 7273, 'budget' => 7700],
                        ['sale' => 7525, 'budget' => 7250],
                        ['sale' => 5128, 'budget' => 5500],
                        ['sale' => 7432, 'budget' => 6400],
                        ['sale' => 9094, 'budget' => 7700],
                        ['sale' => 6646, 'budget' => 6200],
                        ['sale' => 9676, 'budget' => 8700],
                        ['sale' => 9351, 'budget' => 8850],
                        ['sale' => 7156, 'budget' => 7850],
                        ['sale' => 5656, 'budget' => 5250],
                        ['sale' => 6351, 'budget' => 5850],
                        ['sale' => 7799, 'budget' => 7750],
                        ['sale' => 6323, 'budget' => 5900],
                        ['sale' => 10225, 'budget' => 8800],
                        ['sale' => 10340, 'budget' => 8850],
                        ['sale' => 8208, 'budget' => 7950],
                        ['sale' => 5660, 'budget' => 5950],
                        ['sale' => 6304, 'budget' => 6550],
                        ['sale' => 7680, 'budget' => 7300],
                        ['sale' => 7049, 'budget' => 6500],
                        ['sale' => 10474, 'budget' => 8150],
                        ['sale' => 8760, 'budget' => 8000],
                        ['sale' => 2538, 'budget' => 2500],
                        ['sale' => 0, 'budget' => 0],
                        ['sale' => 7759, 'budget' => 6900],
                        ['sale' => 7576, 'budget' => 6500],
                        ['sale' => 8090, 'budget' => 6950],
                        ['sale' => 8344, 'budget' => 8250],
                        ['sale' => 8092, 'budget' => 8250],
                        ['sale' => 2793, 'budget' => 2500],
                    ]
                ],
                '2018' =>[
                    '01' => [
                        ['sale' => 9395, 'budget' => 7700],
                        ['sale' => 7409, 'budget' => 5650],
                        ['sale' => 7372, 'budget' => 6250],
                        ['sale' => 7651, 'budget' => 6500],
                        ['sale' => 10459, 'budget' => 9400],
                        ['sale' => 8100, 'budget' => 8600],
                        ['sale' => 8017, 'budget' => 7750],
                        ['sale' => 5123, 'budget' => 5100],
                        ['sale' => 5801, 'budget' => 5400],
                        ['sale' => 7086, 'budget' => 7500],
                        ['sale' => 6521, 'budget' => 5650],
                        ['sale' => 9641, 'budget' => 7500],
                        ['sale' => 7939, 'budget' => 7600],
                        ['sale' => 6805, 'budget' => 6050],
                        ['sale' => 0, 'budget' => 5100],
                        ['sale' => 0, 'budget' => 5400],
                        ['sale' => 0, 'budget' => 5900],
                        ['sale' => 0, 'budget' => 5500],
                        ['sale' => 0, 'budget' => 8500],
                        ['sale' => 0, 'budget' => 8810],
                        ['sale' => 0, 'budget' => 6600],
                        ['sale' => 0, 'budget' => 4500],
                        ['sale' => 0, 'budget' => 5100],
                        ['sale' => 0, 'budget' => 6500],
                        ['sale' => 0, 'budget' => 4800],
                        ['sale' => 0, 'budget' => 6850],
                        ['sale' => 0, 'budget' => 7600],
                        ['sale' => 0, 'budget' => 6700],
                        ['sale' => 0, 'budget' => 4600],
                        ['sale' => 0, 'budget' => 5300],
                        ['sale' => 0, 'budget' => 6500],
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
        $this->importFromFile('CV', $manager);
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

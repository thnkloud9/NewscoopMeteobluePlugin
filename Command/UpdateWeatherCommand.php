<?php
/**
 * @package Newscoop
 * @copyright 2011 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Newscoop\MeteobluePluginBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use DateTime;
use Newscoop\MeteobluePluginBundle\Entity\MeteoblueStat;

/**
 * Update weather command
 */
class UpdateWeatherCommand extends ContainerAwareCommand
{
    /**
     * @see Console\Command\Command
     */
    protected function configure()
    {
        $this
            ->setName('weather:update')
            ->setDescription('Updates weather information.');
    }

    /**
     * @see Console\Command\Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $icons = array();
        $icons[1] = 'icon-weather-sun';
        $icons[2] = 'icon-weather-sun';
        $icons[3] = 'icon-weather-sun';
        $icons[4] = 'icon-weather-sun-clouds';
        $icons[5] = 'icon-weather-sun-clouds';
        $icons[6] = 'icon-weather-sun-clouds';
        $icons[7] = 'icon-weather-sun-clouds';
        $icons[8] = 'icon-weather-sun-clouds';
        $icons[9] = 'icon-weather-clouds';
        $icons[10] = 'icon-weather-thunder';
        $icons[11] = 'icon-weather-thunder';
        $icons[12] = 'icon-weather-thunder';
        $icons[13] = 'icon-weather-clouds';
        $icons[14] = 'icon-weather-clouds';
        $icons[15] = 'icon-weather-clouds';
        $icons[16] = 'icon-weather-clouds';
        $icons[17] = 'icon-weather-clouds';
        $icons[18] = 'icon-weather-clouds';
        $icons[19] = 'icon-weather-clouds';
        $icons[20] = 'icon-weather-clouds';
        $icons[21] = 'icon-weather-clouds';
        $icons[22] = 'icon-weather-clouds';
        $icons[23] = 'icon-weather-rain';
        $icons[24] = 'icon-weather-snow';
        $icons[25] = 'icon-weather-rain';
        $icons[26] = 'icon-weather-snow';
        $icons[27] = 'icon-weather-thunder';
        $icons[28] = 'icon-weather-thunder';
        $icons[29] = 'icon-weather-snow';
        $icons[30] = 'icon-weather-thunder';
        $icons[31] = 'icon-weather-rain';
        $icons[32] = 'icon-weather-snow';
        $icons[33] = 'icon-weather-rain';
        $icons[34] = 'icon-weather-snow';
        $icons[35] = 'icon-weather-rain';
        
        $date = date('d.m.Y');
        
        $url = "http://www.meteoblue.com/apps/api/call/";
        $parameters = array(
            'wrapkey' => '3575:51:ty29rggi6dancpx',
            'mac' => 'feed',
            'paramtype' => 'datafeed',
            'type' => 'simpleWeatherRain',
            'dt' => '1',
            'featID' => '376',
            'iso2' => 'ch'
        );
        
        $client = new \Zend_Http_Client($url);
        $client->setParameterGet($parameters);
        $body = $client->request()->getBody();
        
        $body = str_replace("\r\n", "", $body);
        $body = str_replace("\n", "", $body);
        
        $data = explode(';', $body);
        //var_dump($data);
        
        $todayKeys = array_keys($data, $date);
       
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $meteoblueStatRepo = $em->getRepository('Newscoop\MeteobluePluginBundle\Entity\MeteoblueStat');
 
        foreach ($todayKeys as $todayKey) {
            //$day = $data[$todayKey];
            $hour = $data[$todayKey + 2];
            $temperature = $data[$todayKey + 3];
            $icon = $icons[$data[$todayKey + 7]];

            // save the temp
            if ($meteoblueStatRepo->countBy(array('option' => 'weather_temperature_'.$hour)) > 0) {
                $tempStat = $em->getRepository('Newscoop\MeteobluePluginBundle\Entity\MeteoblueStat')
                    ->findOneBy(array(
                        'option' => 'weather_temperature_'.$hour,
                    ));
            } else {
                $tempStat = new MeteoblueStat();
                $tempStat->setOption('weather_temperature_'.$hour);
            }
            $tempStat->setValue($temperature);

            // save the icon 
            if ($meteoblueStatRepo->countBy(array('option' => 'weather_icon_'.$hour)) > 0) {
                $iconStat = $em->getRepository('Newscoop\MeteobluePluginBundle\Entity\MeteoblueStat')
                    ->findOneBy(array(
                        'id' => 'weather_icon_'.$hour,
                    ));
            } else {
                $iconStat = new MeteoblueStat();
                $iconStat->setOption('weather_icon_'.$hour);
            }
            $iconStat->setValue($icon);

            $em->flush();
        }
    }
}

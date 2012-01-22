<?php

namespace FrequenceWeb\Bundle\CalendRBundle\Twig;

use CalendR\Calendar;

class CalendRExtension extends \Twig_Extension
{
    private $factory;

    public function __construct(Calendar $factory)
    {
        $this->factory = $factory;
    }

    public function getFunctions()
    {
        return array(
            'calendr_year'   => new \Twig_Function_Method($this, 'getYear'),
            'calendr_month'  => new \Twig_Function_Method($this, 'getMonth'),
            'calendr_week'   => new \Twig_Function_Method($this, 'getWeek'),
            'calendr_day'    => new \Twig_Function_Method($this, 'getDay'),
            'calendr_events' => new \Twig_Function_Method($this, 'getEvents'),
        );
    }

    public function getYear($year)
    {
        return $this->factory->getYear($year);
    }

    public function getMonth($year, $month = null)
    {
        return $this->factory->getMonth($year, $month);
    }

    public function getWeek($year, $week = null)
    {
        return $this->factory->getWeek($year, $week);
    }

    public function getDay($year, $month = null, $day = null)
    {
        return $this->factory->getMonth($year, $month, $day);
    }

    public function getEvents($period)
    {
        return $this->factory->getEvents($period);
    }

    public function getName()
    {
        return 'calendr';
    }
}
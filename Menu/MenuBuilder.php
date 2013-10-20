<?php

namespace Mareg\Bundle\BootstrapBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu
            ->addChild('Home', array('route' => 'mareg_gallery_homepage'))
            ->addChild('About', array('route' => 'mareg_gallery_about'))
            ->addChild('Browse', array('route' => 'mareg_gallery_browse'))
            ->addChild('Latest', array('route' => 'mareg_gallery_latest'))
        ;

        return $menu;
    }
}
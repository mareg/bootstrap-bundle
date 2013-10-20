<?php

namespace Mareg\Bundle\BootstrapBundle\Menu\Renderer;

use Knp\Menu\Renderer\RendererInterface;
use Knp\Menu\ItemInterface;

class NavbarRenderer implements RendererInterface
{
    /**
     * @var \Twig_Environment
     */
    private $environment;
    private $defaultOptions;

    /**
     * @param \Twig_Environment $environment
     * @param string $template
     * @param array $defaultOptions
     */
    public function __construct(\Twig_Environment $environment, $template, array $defaultOptions = array())
    {
        $this->environment = $environment;
        $this->defaultOptions = array_merge(array(
                'depth' => null,
                'currentAsLink' => true,
                'currentClass' => 'current',
                'ancestorClass' => 'current_ancestor',
                'firstClass' => 'first',
                'lastClass' => 'last',
                'template' => $template,
                'compressed' => false,
                'allow_safe_labels' => false,
        ), $defaultOptions);
    }

    public function render(ItemInterface $item, array $options = array())
    {
        $options = array_merge($this->defaultOptions, $options);

        $template = $options['template'];
        if (!$template instanceof \Twig_Template) {
            $template = $this->environment->loadTemplate($template);
        }

        $block = $options['compressed'] ? 'compressed_root' : 'root';

        return $template->renderBlock($block, array('item' => $item, 'options' => $options));
    }
}
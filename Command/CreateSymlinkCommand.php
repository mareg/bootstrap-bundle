<?php

namespace Mareg\Bundle\BootstrapBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSymlinkCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('mareg:bootstrap:create-symlink')
            ->setDescription('Creates symlink to twbs bundle')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $noteOK    = "[ <fg=green>OK</fg=green> ] ";
        $noteError = "[<fg=red>FAIL</fg=red>] ";

        $currentLocation = exec("pwd");

        $symlink   = "/vendor/mareg/bootstrap-bundle/Mareg/Bundle/BootstrapBundle/Resources/twbs";
        $bootstrap = "/vendor/twbs/bootstrap";

        if (!file_exists($currentLocation . $bootstrap)) {
            if (file_exists($currentLocation . $symlink)) {
                $output->writeln($noteOK . 'Link already exists.');
            } else {
                exec("ln -s {$currentLocation}{$bootstrap} {$currentLocation}{$symlink}");
                $output->writeln($noteOK . 'Link has been created.');
            }
        } else {
            $output->writeln($noteError . "Package <options=bold>twbs/bootstrap</options=bold> does not seem to be installed in '.{$bootstrap}'.");
        }
    }
}
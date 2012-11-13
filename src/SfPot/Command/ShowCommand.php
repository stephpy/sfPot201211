<?php

namespace SfPot\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ShowCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('sfpot:show')
            ->setDescription('My description')
            ->addArgument(
                'type',
                InputArgument::OPTIONAL,
                'Food ? Drink ? All ?'
            )
            ->addOption(
                'verbose',
                'v',
                InputOption::VALUE_NONE,
                'Want to be verbose ?'
            )
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kernel    = new \SfPot\Kernel();
        $container = $kernel->boot();
        $event     = $container->get('event_alert');

        $type    = $input->getArgument('type');
        $verbose = $input->getOption('verbose');

        $availableTypes = array('drink', 'food', 'all');
        if (!in_array($type, $availableTypes)) {
            $dialog = $this->getHelperSet()->get('dialog');
            $type   = $dialog->ask($output, 'Drink or food ? nothing else (drink):', 'drink');

            if(!in_array($type, $availableTypes)) {
                throw new \InvalidArgumentException('Hmmmmm');
            }
        }

        if ($verbose) {
            $output->writeln('<info>VERBOSE MODE: blablablabla</info>');
        }

        switch ($type) {
            case 'drink':
                $this->showDrink($output, $event);
            break;
            case 'food':
                $this->showFood($output, $event);
            break;
            default:
                $this->showDrink($output, $event);
                $this->showFood($output, $event);
            break;
        }
    }

    private function showDrink(OutputInterface $output, $event)
    {
        $output->writeln('<info>=========== DRINKS ============</info>');
        foreach ($event->getDrink() as $drink) {
            $output->writeln(sprintf('<comment>%s %s de %s</comment>', $drink->quantity, $drink->type, $drink->ident));
        }
    }

    private function showFood(OutputInterface $output, $event)
    {
        $output->writeln('<info>=========== Food ============</info>');
        foreach ($event->getFood() as $food) {
            $output->writeln(sprintf('<comment>%s</comment>', $food));
        }
    }

}

<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use function is_string;
use function sprintf;
use function usleep;

#[AsCommand(name: 'app:test', description: 'Add a short description for your command')]
final class TestCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $symfonyStyle = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if (is_string($arg1)) {
            $symfonyStyle->note(sprintf('You passed an argument: %s', $arg1));
        }

        /*if ($input->getOption('option1')) {
            // ...
        }*/

        $symfonyStyle->progressStart(100);
        for ($i = 0; $i < 100; $i += 1) {
            $symfonyStyle->progressAdvance();
            usleep(10000);
        }
        $symfonyStyle->progressFinish();

        $symfonyStyle->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}

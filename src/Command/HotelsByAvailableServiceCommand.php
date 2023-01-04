<?php

declare(strict_types=1);

namespace Codenip\Command;

use Codenip\Service\HotelsByService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HotelsByAvailableServiceCommand extends Command
{
    private HotelsByService $service;

    public function __construct(HotelsByService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    public function configure(): void
    {
        $this
            ->setName('codenip:offers:hotels-by-service')
            ->setDescription('This command can search hotels by service')
            ->addArgument('service', InputArgument::REQUIRED, 'The service name');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $service = $input->getArgument('service');

        $total = $this->service->search($service);

        $output->writeln(\sprintf('Hotels with service <%s>: <%d>', $service, $total));

        return self::SUCCESS;
    }
}

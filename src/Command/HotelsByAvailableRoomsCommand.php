<?php

declare(strict_types=1);

namespace Codenip\Command;

use Codenip\Service\HotelsByRooms;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HotelsByAvailableRoomsCommand extends Command
{
    private HotelsByRooms $service;

    public function __construct(HotelsByRooms $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    public function configure(): void
    {
        $this
            ->setName('codenip:offers:hotels-by-available-rooms')
            ->setDescription('This command can search hotels with available rooms in a given range')
            ->addArgument('min', InputArgument::REQUIRED, 'Minimum available rooms')
            ->addArgument('max', InputArgument::REQUIRED, 'Maximum available rooms');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $min = (int)$input->getArgument('min');
        $max = (int)$input->getArgument('max');

        $total = $this->service->search($min, $max);

        $output->writeln(\sprintf('Hotels with min <%d> and max <%d> available rooms: <%d>', $min, $max, $total));

        return self::SUCCESS;
    }
}

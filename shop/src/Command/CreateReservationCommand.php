<?php

declare(strict_types=1);

namespace App\Command;

use App\Handler\CreateReservationHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateReservationCommand extends Command
{
    private const ARGUMENT_EAN = 'ean';
    private const ARGUMENT_QUANTITY = 'quantity';

    /** @var CreateReservationHandler */
    private $handler;

    public function __construct(CreateReservationHandler $handler)
    {
        $this->handler = $handler;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('stock:reservation-create');
        $this->addArgument(self::ARGUMENT_EAN, InputArgument::REQUIRED);
        $this->addArgument(self::ARGUMENT_QUANTITY, InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->handler->handle(
            $input->getArgument(self::ARGUMENT_EAN),
            (int) $input->getArgument(self::ARGUMENT_QUANTITY)
        );

        $output->writeln($result);

        return 0;
    }
}

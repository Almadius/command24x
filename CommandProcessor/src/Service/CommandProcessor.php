<?php

namespace CommandProcessor\Service;

use CommandProcessor\Contract\CommandInterface;
use CommandProcessor\Contract\DealContextInterface;
use CommandProcessor\Exception\CommandNotSupportedException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class CommandProcessor
{
    /**
     * @var CommandInterface[]
     */
    private array $handlers = [];

    private LoggerInterface $logger;

    public function __construct(?LoggerInterface $logger = null)
    {
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * @param CommandInterface $handler
     */
    public function addHandler(CommandInterface $handler): void
    {
        $this->handlers[] = $handler;
    }

    /**
     * Обработка текстовой команды пользователя.
     */
    public function handle(string $command, DealContextInterface $deal): string
    {
        $this->logger->info("Получена команда: {$command}");

        foreach ($this->handlers as $handler) {
            if ($handler->supports($command)) {
                $this->logger->info("Обработчик найден: " . get_class($handler));
                $result = $handler->handle($command, $deal);
                $this->logger->info("Результат: {$result}");
                return $result;
            }
        }

        $this->logger->warning("Неизвестная команда: {$command}");
        throw new CommandNotSupportedException("Команда не распознана.");
    }
}

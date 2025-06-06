<?php

namespace CommandProcessor\Contract;

interface CommandInterface
{
    /**
     * Проверяет, поддерживает ли команда переданный текст.
     */
    public function supports(string $command): bool;

    /**
     * Обрабатывает команду в контексте сделки.
     *
     * @param string $command Полная команда пользователя
     * @param DealContextInterface $deal Контекст текущей сделки
     *
     * @return string Результат обработки (например, строка для UI)
     */
    public function handle(string $command, DealContextInterface $deal): string;
}

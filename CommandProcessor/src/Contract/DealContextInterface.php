<?php

namespace CommandProcessor\Contract;

interface DealContextInterface
{
    /**
     * Установить значение свойства сделки
     */
    public function setProperty(int $propertyId, string $value): void;

    /**
     * Получить значение свойства сделки
     */
    public function getProperty(int $propertyId): string;

    /**
     * Получить контакт клиента, связанный со сделкой
     */
    public function getContact(): string;

    /**
     * Добавить служебное сообщение к сделке
     */
    public function addMessage(string $message): void;
}

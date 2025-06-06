<?php

use PHPUnit\Framework\TestCase;
use CommandProcessor\Service\CommandProcessor;
use CommandProcessor\Command\AcceptedCommand;
use Tests\Fake\FakeDealContext;
use CommandProcessor\Logger\SimpleLogger;

class CommandProcessorTest extends TestCase
{
    public function testAcceptedCommandSetsPropertiesCorrectly(): void
    {
        $processor = new CommandProcessor(new SimpleLogger());

        $processor->addHandler(new AcceptedCommand());

        $context = new FakeDealContext();

        $result = $processor->handle('/принято 500 офис', $context);

        $this->assertSame('Свойства сделки обновлены.', $result);

        $props = $context->getProperties();

        $this->assertEquals('500', $props[14] ?? null);
        $this->assertEquals('офис', $props[15] ?? null);
    }

    public function testContactCommandAddsClientContactMessage(): void
    {
        $processor = new CommandProcessor(new SimpleLogger());

        $processor->addHandler(new \CommandProcessor\Command\ContactCommand());

        $context = new \Tests\Fake\FakeDealContext();

        $result = $processor->handle('/контакт', $context);

        $this->assertSame('Сообщение добавлено.', $result);

        $messages = $context->getMessages();

        $this->assertCount(1, $messages);
        $this->assertEquals('Контакт клиента: +70000000000', $messages[0]);
    }

    public function testCloseReasonCommandSetsProperty222(): void
    {
        $processor = new CommandProcessor(new SimpleLogger());

        $processor->addHandler(new \CommandProcessor\Command\CloseReasonCommand());

        $context = new \Tests\Fake\FakeDealContext();

        $result = $processor->handle('/причина_закрытия удалена транзакция', $context);

        $this->assertSame('Причина закрытия обновлена.', $result);

        $props = $context->getProperties();

        $this->assertArrayHasKey(222, $props);
        $this->assertEquals('удалена транзакция', $props[222]);
    }

    public function testReasonCommandAddsCloseReasonMessage(): void
    {
        $processor = new CommandProcessor(new SimpleLogger());

        $processor->addHandler(new \CommandProcessor\Command\ReasonCommand());

        $context = new \Tests\Fake\FakeDealContext();
        $context->setProperty(222, 'нецелевой трафик');

        $result = $processor->handle('/причина', $context);

        $this->assertSame('Сообщение добавлено.', $result);

        $messages = $context->getMessages();

        $this->assertCount(1, $messages);
        $this->assertEquals('Причина закрытия: нецелевой трафик', $messages[0]);
    }
}

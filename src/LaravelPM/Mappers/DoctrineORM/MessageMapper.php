<?php

namespace LaravelPM\Mappers\DoctrineORM;

use Doctrine\Common\Persistence\ObjectManager;
use LaravelPM\Mappers\MessageMapperInterface;
use LaravelPM\Models\Conversation;
use LaravelPM\Models\ConversationInterface;
use LaravelPM\Models\Message;
use LaravelPM\Models\MessageInterface;
use LaravelPM\Models\UserInterface;

class MessageMapper implements MessageMapperInterface
{
    /** @var ObjectManager */
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Find message from id
     *
     * @param string $id
     * @return MessageInterface|null
     */
    public function find($id)
    {
        return $this->objectManager->find(Message::class, $id);
    }

    /**
     * Save message
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function save(MessageInterface $message)
    {
        $this->objectManager->persist($message);
        $this->objectManager->flush();

        return $message;
    }

    /**
     * Remove message
     *
     * @param MessageInterface $message
     * @return bool
     */
    public function remove(MessageInterface $message)
    {
        $this->objectManager->remove($message);
        $this->objectManager->flush();

        return true;
    }

    /**
     * Find user conversations
     *
     * @param UserInterface $user
     * @return ConversationInterface[]|array
     */
    public function getUserConversations(UserInterface $user)
    {
        return $this->objectManager->getRepository(Conversation::class)->findBy([
            'user' => $user,
        ]);
    }
}

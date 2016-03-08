<?php

namespace LaravelPM\Mappers\DoctrineORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use LaravelPM\Mappers\ConversationMapperInterface;
use LaravelPM\Models\ConversationInterface;

class ConversationMapper implements ConversationMapperInterface
{
    /** @var EntityManager */
    protected $objectManager;

    /** @var string */
    protected $conversationModel;

    public function __construct(ObjectManager $objectManager, $conversationModel)
    {
        $this->objectManager = $objectManager;

        $this->conversationModel = $conversationModel;
    }

    /**
     * Find conversation from id
     *
     * @param string $id
     * @return ConversationInterface|null
     */
    public function find($id)
    {
        return $this->objectManager->find($this->conversationModel, $id);
    }

    /**
     * Save conversation
     *
     * @param ConversationInterface $conversation
     * @return ConversationInterface
     */
    public function save(ConversationInterface $conversation)
    {
        $this->objectManager->persist($conversation);
        $this->objectManager->flush();

        return $conversation;
    }

    /**
     * Remove conversation
     *
     * @param ConversationInterface $conversation
     * @return bool
     */
    public function remove(ConversationInterface $conversation)
    {
        $this->objectManager->remove($conversation);
        $this->objectManager->flush();

        return true;
    }
}

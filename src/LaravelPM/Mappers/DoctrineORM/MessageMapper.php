<?php

namespace LaravelPM\Mappers\DoctrineORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use LaravelPM\Mappers\MessageMapperInterface;
use LaravelPM\Models\Conversation;
use LaravelPM\Models\ConversationInterface;
use LaravelPM\Models\Message;
use LaravelPM\Models\MessageInterface;
use LaravelPM\Models\ParticipantInterface;
use LaravelPM\Models\UserInterface;

class MessageMapper implements MessageMapperInterface
{
    /** @var EntityManager */
    protected $objectManager;

    /** @var string */
    protected $messageModel;

    /** @var string */
    protected $conversationModel;

    /** @var string */
    protected $participantModel;

    public function __construct(ObjectManager $objectManager, $messageModel, $conversationModel, $participantModel)
    {
        $this->objectManager = $objectManager;

        $this->messageModel = $messageModel;
        $this->conversationModel = $conversationModel;
        $this->participantModel = $participantModel;
    }

    /**
     * Find message from id
     *
     * @param string $id
     * @return MessageInterface|null
     */
    public function find($id)
    {
        return $this->objectManager->find($this->messageModel, $id);
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
     * Find user conversation
     *
     * @param UserInterface $user
     * @return array|\LaravelPM\Models\ParticipantInterface[]
     */
    public function getUserConversations(UserInterface $user)
    {
        $query = $this->objectManager->createQuery(sprintf(
            'select
              p
            from
              %s p
            where
              p.user = :userId',
            $this->participantModel
            ));

        $query->setParameter('userId', $user->getId());

        /** @var ParticipantInterface[]|array $participantLinks */
        $participantLinks = $query->getResult();

        /** @var ConversationInterface $conversations */
        $conversations = [];

        foreach ($participantLinks as $participantLink) {
            $conversations[] = $participantLink->getConversation();
        }

        return $conversations;
    }

    /**
     * Compose new conversation
     *
     * @param ConversationInterface $conversationInterface
     * @return ConversationInterface
     */
    public function compose(ConversationInterface $conversationInterface)
    {
        $this->objectManager->persist($conversationInterface);
        return $conversationInterface;
    }
}

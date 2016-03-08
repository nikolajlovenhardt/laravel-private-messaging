<?php

namespace LaravelPM\Mappers\DoctrineORM;

use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use LaravelPM\Mappers\MessageMapperInterface;
use LaravelPM\Models\Conversation;
use LaravelPM\Models\ConversationInterface;
use LaravelPM\Models\Message;
use LaravelPM\Models\MessageInterface;
use LaravelPM\Models\ParticipantInterface;
use LaravelPM\Models\UserInterface;
use Rhumsaa\Uuid\Uuid;

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
     * Create message
     *
     * @param string $text
     * @param UserInterface $user
     * @param ConversationInterface $conversation
     * @return MessageInterface
     */
    public function create($text, UserInterface $user, ConversationInterface $conversation)
    {
        /** @var MessageInterface $message */
        $message = new $this->messageModel;

        $message->setId(Uuid::uuid4());
        $message->setDate(new DateTime());
        $message->setMessage($text);
        $message->setUser($user->getId());
        $message->setConversation($conversation);
        $message->setRead(0);

        return $this->save($message);
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
}

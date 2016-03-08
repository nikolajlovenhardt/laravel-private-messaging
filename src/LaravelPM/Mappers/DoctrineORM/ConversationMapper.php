<?php

namespace LaravelPM\Mappers\DoctrineORM;

use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use LaravelPM\Exceptions\MissingFieldsException;
use LaravelPM\Mappers\ConversationMapperInterface;
use LaravelPM\Models\ConversationInterface;
use LaravelPM\Models\ParticipantInterface;
use PM;
use Rhumsaa\Uuid\Uuid;

class ConversationMapper implements ConversationMapperInterface
{
    /** @var EntityManager */
    protected $objectManager;

    /** @var string */
    protected $conversationModel;

    /** @var string */
    protected $participantModel;

    public function __construct(ObjectManager $objectManager, $conversationModel, $participantModel)
    {
        $this->objectManager = $objectManager;

        $this->conversationModel = $conversationModel;
        $this->participantModel = $participantModel;
    }

    /**
     * Find conversation from id
     *
     * @param string $id
     * @return ConversationInterface|null
     */
    public function find($id)
    {
        /** @var ConversationInterface|null $conversation */
        $conversation = $this->objectManager->find($this->conversationModel, $id);

        return $conversation;
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

    /**
     * Compose new conversation
     *
     * @param array $data
     * @return ConversationInterface
     * @throws MissingFieldsException
     */
    public function compose(array $data)
    {
        if (
            !isset($data['participants']) ||
            !isset($data['subject']) ||
            !isset($data['message'])
        ) {
            throw new MissingFieldsException();
        }

        /** @var \LaravelPM\Models\UserInterface|null $identity */
        if (!$identity = PM::currentUser()) {
            return false;
        }

        /** @var ConversationInterface $conversation */
        $conversation = new $this->conversationModel;
        $conversation->setId(Uuid::uuid4());
        $conversation->setSubject($data['subject']);
        $conversation->setDate(new DateTime());
        $conversation->setUpdated(new DateTime());

        $this->save($conversation);

        // Add current user to conversation
        $this->addParticipant($identity->getId(), $conversation);

        // Add other participants
        foreach ($data['participants'] as $participant) {
            $this->addParticipant($participant, $conversation);
        }

        return $conversation;
    }

    /**
     * Add new participant to conversation
     *
     * @param string $userId
     * @param ConversationInterface $conversation
     * @return ParticipantInterface
     */
    public function addParticipant($userId, ConversationInterface $conversation)
    {
        /** @var ParticipantInterface $participant */
        $participant = new $this->participantModel;

        $participant->setId(Uuid::uuid4());
        $participant->setUser($userId);
        $participant->setConversation($conversation);

        $this->objectManager->persist($participant);
        $this->objectManager->flush();

        return $participant;
    }
}

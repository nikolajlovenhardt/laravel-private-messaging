<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace LaravelPM\Services;

use LaravelPM\Mappers\ConversationMapperInterface;
use LaravelPM\Mappers\MessageMapperInterface;
use LaravelPM\Mappers\UserMapperInterface;
use LaravelPM\Models\ConversationInterface;
use LaravelPM\Models\MessageInterface;
use LaravelPM\Models\UserInterface;
use PM;

class PMService implements PMServiceInterface
{
    /** @var EventService */
    protected $eventService;

    /** @var MessageMapperInterface */
    protected $messageMapper;

    /** @var ConversationMapperInterface */
    protected $conversationMapper;

    /** @var UserMapperInterface */
    protected $userMapper;

    public function __construct(
        EventService $eventService,
        MessageMapperInterface $messageMapper,
        ConversationMapperInterface $conversationMapper,
        UserMapperInterface $userMapper
    ) {
        $this->eventService = $eventService;
        $this->messageMapper = $messageMapper;
        $this->conversationMapper = $conversationMapper;
        $this->userMapper = $userMapper;
    }

    /**
     * Find conversation
     *
     * @param string $id
     * @return ConversationInterface|null
     */
    public function find($id)
    {
        return $this->conversationMapper->find($id);
    }

    /**
     * Check if user is participant to a conversation
     *
     * @param ConversationInterface $conversation
     * @param UserInterface $user
     * @return bool
     */
    public function isParticipant(ConversationInterface $conversation, UserInterface $user)
    {
        foreach ($conversation->getParticipants() as $participant) {
            if ($participant->getUser() === $user->getId()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Find all users
     *
     * @return UserInterface[]
     */
    public function getAllUsers()
    {
        return $this->userMapper->findAll();
    }

    /**
     * Get user conversations
     *
     * @param UserInterface $user
     * @return array|\LaravelPM\Models\ConversationInterface[]
     */
    public function getUserConversations(UserInterface $user)
    {
        return $this->messageMapper->getUserConversations($user);
    }

    /**
     * Send message
     *
     * @param MessageInterface $message
     */
    public function send(MessageInterface $message)
    {
        $this->messageMapper->save($message);
    }

    /**
     * Compose new conversation
     *
     * @param array $data
     * @return bool|ConversationInterface
     */
    public function compose(array $data)
    {
        // Create conversation
        if (!$conversation = $this->conversationMapper->compose($data)) {
            return false;
        }

        // Create message
        $this->messageMapper->create($data['message'], PM::currentUser(), $conversation);

        return $conversation;
    }
}

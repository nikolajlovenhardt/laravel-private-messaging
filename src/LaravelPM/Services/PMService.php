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

use LaravelPM\Mappers\MessageMapperInterface;
use LaravelPM\Models\ConversationInterface;
use LaravelPM\Models\MessageInterface;
use LaravelPM\Models\UserInterface;

class PMService implements PMServiceInterface
{
    /** @var EventService */
    protected $eventService;

    /** @var MessageMapperInterface */
    protected $messageMapper;

    public function __construct(EventService $eventService, MessageMapperInterface $messageMapper)
    {
        $this->eventService = $eventService;
        $this->messageMapper = $messageMapper;
    }

    /**
     * Find message
     *
     * @param string $id
     * @return MessageInterface|null
     */
    public function find($id)
    {
        return $this->messageMapper->find($id);
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
     * @param ConversationInterface $conversation
     * @return bool|ConversationInterface
     */
    public function compose(ConversationInterface $conversation)
    {
        if (!$conversation = $this->messageMapper->compose($conversation)) {
            return false;
        }

        return $conversation;
    }
}

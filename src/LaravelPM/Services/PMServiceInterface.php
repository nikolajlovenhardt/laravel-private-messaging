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

use LaravelPM\Models\ConversationInterface;
use LaravelPM\Models\MessageInterface;
use LaravelPM\Models\UserInterface;

interface PMServiceInterface
{
    /**
     * Find conversation
     *
     * @param string $id
     * @return ConversationInterface|null
     */
    public function find($id);

    /**
     * Reply to conversation
     *
     * @param array $data
     * @param ConversationInterface $conversation
     * @return MessageInterface|boolean
     */
    public function reply(array $data, ConversationInterface $conversation);

    /**
     * Send message
     *
     * @param MessageInterface $message
     */
    public function send(MessageInterface $message);

    /**
     * Get user conversations
     *
     * @param UserInterface $user
     * @return array|\LaravelPM\Models\ConversationInterface[]
     */
    public function getUserConversations(UserInterface $user);

    /**
     * Compose new conversation
     *
     * @param array $data
     * @return ConversationInterface|boolean
     */
    public function compose(array $data);

    /**
     * Check if a user is a part of a conversation
     *
     * @param ConversationInterface $conversation
     * @param UserInterface $user
     * @return boolean
     */
    public function isParticipant(ConversationInterface $conversation, UserInterface $user);

    /**
     * Get all users
     *
     * @return UserInterface[]|array
     */
    public function getAllUsers();
}

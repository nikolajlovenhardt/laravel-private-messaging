<?php

namespace LaravelPM\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use LaravelPM\Exceptions\InvalidConversationException;
use LaravelPM\Exceptions\InvalidMessageException;
use LaravelPM\Models\Conversation;
use LaravelPM\Models\UserInterface;
use LaravelPM\Services\PMServiceInterface;

class PMController extends BaseController
{
    /** @var PMServiceInterface */
    protected $pmService;

    public function __construct(PMServiceInterface $pmService)
    {
        $this->pmService = $pmService;
    }

    /**
     * Read message
     *
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function read($id)
    {
        $pmService = $this->pmService;

        /** @var UserInterface|null $user */
        $user = $this->getIdentity();

        if (!$conversation = $pmService->find($id)) {
            throw new InvalidConversationException($id);
        }

        if (!$user || !$pmService->isParticipant($conversation, $user)) {
            throw new InvalidConversationException($id);
        }

        return view('pm::read', [
            'conversation' => $conversation,
        ]);
    }

    /**
     * View inbox
     */
    public function inbox()
    {
        $pmService = $this->pmService;

        /** @var UserInterface|null $user */
        $user = $this->getIdentity();

        $conversations = $pmService->getUserConversations($user);

        return view('pm::inbox', [
            'conversations' => $conversations,
        ]);
    }

    /**
     * Compose new conversation
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function compose(Request $request)
    {
        $view = view('pm.compose');
        $pmService = $this->pmService;

        if (!$request->isMethod('post')) {
            return $view;
        }

        $data = $request->all();

        if ($request->has(['subject', 'message'])) {
            return $view;
        }

        $conversation = new Conversation();
        $conversation->setSubject($data['subject']);

        if (!$pmService->compose($conversation)) {
            return $view;
        }

        // Success
    }

    /**
     * @return UserInterface|null
     */
    protected function getIdentity()
    {
        return Auth::user();
    }
}

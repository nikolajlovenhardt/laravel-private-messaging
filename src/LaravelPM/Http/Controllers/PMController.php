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
    public function conversation($id)
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

        return view('pm::conversation', [
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
        $pmService = $this->pmService;
        $users = $pmService->getAllUsers();

        $view = view('pm::compose', [
            'users' => $users,
        ]);

        if (!$request->isMethod('post')) {
            return $view;
        }

        if (!$request->has(['participants', 'subject', 'message'])) {
            return $view;
        }

        // Check for required fields
        if (
            empty($request->input('participants')) ||
            empty($request->input('subject')) ||
            empty($request->input('message'))
        ) {
            return $view;
        }

        if (!$conversation = $pmService->compose($request->all())) {
            return $view;
        }

        return redirect()->route('pm.conversation', [
            'id' => $conversation->getId(),
        ]);
    }

    /**
     * @return UserInterface|null
     */
    protected function getIdentity()
    {
        return Auth::user();
    }
}

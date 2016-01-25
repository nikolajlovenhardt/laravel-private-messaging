<?php

namespace LaravelPM\Http\Controllers;

use Auth;
use Illuminate\Routing\Controller as BaseController;
use LaravelPM\Exceptions\InvalidMessageException;
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

        if (!$message = $pmService->find($id)) {
            throw new InvalidMessageException($id);
        }

        if (!$user || $message->getUser() !== $user->getId()) {
            throw new InvalidMessageException($id);
        }

        return view('pm.read', [
            'message' => $message,
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

        return view('pm.inbox', [
            'conversations' => $conversations,
        ]);
    }

    public function compose()
    {

    }

    /**
     * Get identity
     *
     * @return UserInterface|null
     */
    protected function getIdentity()
    {
        return Auth::user();
    }
}

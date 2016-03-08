<?php
/** @var \LaravelPM\Models\ConversationInterface[] $conversations */
?>
<h1>Conversations</h1>

@foreach($conversations as $conversation)
    <a href="{!! route('pm.read', ['id' => $conversation->getId()]) !!}" title="Read conversation">
        <strong>{{$conversation->getSubject()}}</strong><br />
        Last reply: {{$conversation->getUpdated()->format('m/d/Y H:i')}}<br />
        Participants:<br >
        @foreach ($conversation->getParticipants() as $participant)
            - {{PM::user($participant->getUser())->getDisplayName()}}<br />
        @endforeach
    </a>

    <hr />
@endforeach
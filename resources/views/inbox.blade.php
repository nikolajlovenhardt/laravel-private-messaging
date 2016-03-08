<?php
/** @var \LaravelPM\Models\ConversationInterface[] $conversations */
?>
<h1>Conversations</h1>

<a href="{{route('pm.compose')}}" title="{{_('Compose new message')}}">
    {{_('Compose new message')}}
</a>

<hr />

@foreach($conversations as $conversation)
    <a href="{!! route('pm.conversation', ['id' => $conversation->getId()]) !!}" title="Read conversation">
        <strong>{{$conversation->getSubject()}}</strong><br />
        Last reply: {{$conversation->getUpdated()->format('m/d/Y H:i')}}<br />
        Participants:<br >
        @foreach ($conversation->getParticipants() as $participant)
            - {{PM::user($participant->getUser())->getDisplayName()}}<br />
        @endforeach
    </a>

    <hr />
@endforeach
<?php
/** @var \LaravelPM\Models\ConversationInterface $conversation */
?>
<h1>{{$conversation->getSubject()}}</h1>
<span class="created">Conversation started {{$conversation->getDate()->format('m/d/Y H:i')}}</span><br />
<br />

@foreach($conversation->getMessages() as $message)
    <strong>{{PM::user($message->getUser())->getDisplayName()}}</strong> {{$message->getDate()->format('m/d/Y H:i')}}<br />
    {{$message->getMessage()}}
    <hr />
@endforeach

@include('pm::reply', ['conversation' => $conversation])
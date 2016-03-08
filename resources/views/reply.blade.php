<?php
/** @var \LaravelPM\Models\ConversationInterface $conversation */
?>

<form action="{{route('pm.reply', ['conversation' => $conversation->getId()])}}">
    {!! csrf_field() !!}

    <label for="message">
        {{_('Message:')}}<br />
        <textarea name="message" required="required">{{old('message')}}</textarea>
    </label>

    <br />

    <button type="submit">{{_('Reply')}}</button>
</form>
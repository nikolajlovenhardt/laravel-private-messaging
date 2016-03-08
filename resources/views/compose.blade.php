<h1>{{_('Compose')}}</h1>

<form action="{{route('pm.compose')}}" method="post">
    {!! csrf_field() !!}

    <label for="subject">
        {{_('To:')}}<br />
        <select name="participants[]" multiple="multiple" required="required">
            @foreach($users as $user)
                @if($user != PM::currentUser())
                    <option value="{{$user->getId()}}">{{$user->getDisplayName()}}</option>
                @endif
            @endforeach
        </select>
    </label>

    <br />

    <label for="subject">
        {{_('Subject:')}}<br />
        <input type="text" id="subject" name="subject" value="{{old('subject')}}" required="required" />
    </label>

    <br />

    <label for="message">
        {{_('Message:')}}<br />
        <textarea name="message" required="required">{{old('message')}}</textarea>
    </label>

    <br />

    <button type="submit">{{_('Compose')}}</button>
</form>
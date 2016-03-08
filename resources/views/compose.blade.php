<h1>{{_('Compose')}}</h1>

<form action="{{route('pm.compose')}}" method="post">
    {!! csrf_field() !!}

    <label for="subject">
        {{_('To:')}}<br />
        <select name="to" multiple="multiple">
            @foreach($users as $user)
                <option value="{{$user->getId()}}">{{$user->getDisplayName()}}</option>
            @endforeach
        </select>
    </label>

    <br />

    <label for="subject">
        {{_('Subject:')}}<br />
        <input type="text" id="subject" name="subject" value="{{old('subject')}}" />
    </label>

    <br />

    <label for="subject">
        {{_('Message:')}}<br />
        <textarea name="message">{{old('message')}}</textarea>
    </label>

    <br />

    <button type="submit">{{_('Compose')}}</button>
</form>
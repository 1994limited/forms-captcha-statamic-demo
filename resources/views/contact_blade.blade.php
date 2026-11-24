@extends('layouts.blade')

@section('content')
    <h1>{{ $title }}</h1>
    <p>The contact form again, drawn by a Blade template with <code>&lt;s:form:create&gt;</code>.</p>

    <s:form:create in="contact" class="form">
        @if ($success)
            <p class="success" role="status">Thanks: we'll write back within a couple of days.</p>
        @else
            @foreach ($fields as $field)
                @if ($field['type'] === 'captcha')
                    @continue
                @endif
                <div class="field">
                    <label for="{{ $field['id'] }}">{{ $field['display'] }}</label>
                    {!! $field['field'] !!}
                    @if ($field['error'])
                        <p class="error" id="{{ $field['id'] }}-error">{{ $field['error'] }}</p>
                    @endif
                </div>
            @endforeach

            {{-- The Captcha field, placed by the tag. In Blade it needs the fields passed in. --}}
            <s:forms_captcha :fields="$fields" />

            <button class="button">Send</button>
        @endif
    </s:form:create>
@endsection

<h2>{{ _lang('Hi') }},</h2>
<p>{{ _lang('You received an email from') }} : {{ $content->name }}</p>
<p>{{ _lang('Here are the details') }}:</p>
<p>{{ _lang('Name') }}: {{ $content->name }}</p>
<p>{{ _lang('Email') }}: {{ $content->email }}</p>
<p>{{ _lang('Phone') }}: {{ $content->phone }}</p>
<p>{{ _lang('Message') }}: @php echo clean($content->message) @endphp</p>
<p>{{ _lang('Thank You') }}</p>
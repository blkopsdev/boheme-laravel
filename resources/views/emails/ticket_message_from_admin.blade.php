
<p>Beste {{ $ticket['name'] }},</p>

<p>Er staat een nieuw bericht voor u klaar op: <a href="{{ route('ticket', ['id' => $ticket['id'], 'token' => $ticket['token']]) }}">{{ route('ticket', ['id' => $ticket['id'], 'token' => $ticket['token']]) }}</a></p>
<p>Met vriendelijke groet</p>

<p>IQ Script</p>

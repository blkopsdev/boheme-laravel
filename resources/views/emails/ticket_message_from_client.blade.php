
<p>Beste {{ $ticket['name'] }},</p>
<p>Wij hebben uw ticket in goede orde ontvangen. Wij gaan zo snel mogelijk aan de slag om uw ticket te verwerken.</p>
<p>U kunt de progressie volgen via: <a href="{{ route('ticket', ['id' => $ticket['id'], 'token' => $ticket['token']]) }}">{{ route('ticket', ['id' => $ticket['id'], 'token' => $ticket['token']]) }}</a></p>
<p>Ook kunt u hier direct berichten versturen naar de agent die aan de slag gaat met uw ticket! </p>
<p>Met vriendelijke groet,</p>
<p>IQ Script</p>

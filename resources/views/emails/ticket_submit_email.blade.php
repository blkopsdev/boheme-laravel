<p>Beste manager,</p>

<p>Er is een nieuwe ticket aangemaakt door {{ $ticket['name'] }}: </p>
<p>Prioriteit: {{ $ticket['priority'] }}</p>
<h3>Bericht</h3>
<p>Onderwerpen: {{ $ticket->getContent()->subject }}</p>
@if ($ticket->getContent()->note)
<p>Opmerking: {!! $ticket->getContent()->note !!}</p>
@endif

<p>Met vriendelijke groet,</p>
<p>IQ Script</p>
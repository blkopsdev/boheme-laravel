<p>Beste {{ $project['name'] }},</p>

<p>Wij hebben achter de schermen hard gewerkt aan de webshop en hebben waar mogelijk alles klaargezet. Wij hebben echter nog wel enkele input van uw kant nodig voordat wij naar de volgende fase van het project gaan.</p>
<p>U kunt de eerste versie van de webshop bekijken op: <a href="{{ $project['testing_url'] }}">{{ $project['testing_url'] }}</a></p>

<p>U kunt de input via de volgende link aanleveren: <a href="{{ route('content_adding', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('content_adding', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>
<p>Wij kijken uit naar de input!</p>
<p>Voor vragen kunt u mij altijd mailen of bellen. </p>

<p>Met vriendelijke groet,</p>
<p style="margin-bottom: 5px;"><strong>{{ $user['name'] }}</strong></p>
<p style="margin-top: 5px; margin-bottom: 5px;">{{ $user['occupation'] }}</p>
<p style="margin-top: 5px; margin-bottom: 5px;"><em>{{$user['phone']}}</em></p>
<p><img src="{{ asset('uploads/users/' . $user['image_name']) }}" alt="{{ $user['name'] }}" width="100"></p>
@if (strpos($user['website_url'], 'http') !== false) 
  <a href="{{ $user['website_url'] }}">{{$user['website_url']}}</a>
@else
  <a href="http://{{ $user['website_url'] }}">{{$user['website_url']}}</a>
@endif
<p>Beste {{ $project['name'] }},</p>

<p>Voordat wij de website kunnen gaan ontwikkelen gaan wij eerst aan de slag met het logo en huisstijl. Wij hebben echter nog wel enkele input van uw kant nodig, om een zo goed mogelijk beeld te krijgen van uw wensen.</p>

<p>U kunt de input via de volgende link aanleveren: <a href="{{ route('logo_design', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('logo_design', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

<p>Voor vragen kunt u mij altijd mailen of bellen.</p>

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
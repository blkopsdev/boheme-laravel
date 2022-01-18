
<p>Beste {{ $project['name'] }},</p>
<p>Ik heb net enkele pogingen gedaan om in te loggen bij de domein provider, maar ik krijg een foutmelding. Het ziet er naar uit dat de inloggegevens niet correct zijn. </p>
<p>Ik wil u graag verzoeken om te kijken of u wel de juiste inloggegevens heeft gegeven. Zo niet zou u dan de goede inloggevens willen mailen? Bij voorbaat dank! </p>
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

<p>Beste {{ $project['name'] }},</p>
<p>Ik was met het project bezig en ik kwam erachter dat er nog te weinig foto’s waren aangeleverd van uw kant om de website goed op te kunnen vullen. Ik wil u dan graag verzoeken om nogmaals via de mail extra foto’s naar mij op te sturen.</p>
<p>Let er wel op dat u de pagina benoemd in de bestandsnaam:</p>
<p>Bijvoorbeeld: Home.jpeg, home1.jpeg, over_ons.jpeg</p>
<p>Bij voorbaat dank! </p>
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
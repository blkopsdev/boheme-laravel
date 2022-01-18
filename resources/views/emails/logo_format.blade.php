
<p>Beste {{ $project['name'] }},</p>
<p>Tijdens het proces ben ik erachter gekomen dat het logo niet in het goede formaat/onscherpe kwaliteit is aangeleverd.</p>
<p>Graag ontvang ik het logo in het volgende formaat:</p>
<ul>
  <li>Als mogelijk een .eps of .svg bestand</li>
  <li>Wanneer dit niet mogelijk is wil ik u graag verzoeken om een transparante versie van het logo aan te leveren.</li>
  <li>Let ook op de scherpte van het logo</li>
</ul>

<p>Mocht u dit niet kunnen aanleveren is dit geen ramp, dan gebruik ik het huidige logo! Dit staat echter wel minder professioneel. Mocht u willen dat wij het logo proberen te optimaliseren kunt u hier ook voor kiezen, echter brengt dit wel extra kosten met zich mee. </p>
<p>Ik kijk uit naar uw reactie.</p>
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
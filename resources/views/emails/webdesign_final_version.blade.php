
<p>Beste {{ $project['name'] }},</p>

<p>Ik heb de feedback zo goed mogelijk proberen door te voeren in het webdesign, zie bijlage. Ik hoor graag of u nog feedback of opmerkingen heeft. Zoals afgesproken heeft u nog één feedback ronde waarin u feedback kunt geven over het webdesign. Mocht u hier gebruik van willen maken kunt u via onderstaande link alle input aanleveren.</p>

<p>U kunt de feedback via de volgende link naar ons sturen: <a href="{{ route('webdesign_version_2', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('webdesign_version_2', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

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
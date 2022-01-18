
<p>Beste {{ $project['name'] }},</p>

<p>Wij hebben alle feedback doorgevoerd! Wij hebben onze uiterste best gedaan om alles op de juiste manier door te voeren.</p>
<p>Zoals afgesproken heeft u twee keer de mogelijkheid om feedback door te geven. Via de onderstaande link kunt u de laatste feedback aan ons doorgeven. Ik wil u graag verzoeken om de website een laatste keer goed door te nemen. Uiteraard kunt u na oplevering nog steeds alles zelf aanpassen m.b.v. onze gratis video cursus.
</p>

<p>Vervolgens kunt u de laatste feedback aan ons doorgeven via de volgende link: <a href="{{ route('final_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('final_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

@if ($project['testing_url'])
<p>U kunt de website bekijken op: <a href="{{ $project['testing_url'] }}">{{ $project['testing_url'] }}</a></p>
@endif

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
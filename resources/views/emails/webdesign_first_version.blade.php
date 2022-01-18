
<p>Beste {{ $project['name'] }},</p>

<p>We zijn klaar met de eerste versie van het webdesign! Ik hoop dat dit in de buurt komt van hoe u het zelf in gedachte had. U kunt de feedback over het webdesign via de volgende link aanleveren: <a href="{{ route('webdesign_version_1', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('webdesign_version_1', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>
<p>Voor vragen kunt mij altijd mailen of bellen.</p>
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
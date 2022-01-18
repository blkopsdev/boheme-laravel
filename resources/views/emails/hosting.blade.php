
<p>Beste {{ $project['name'] }},</p>

<p>Wij zijn aan de slag gegaan met de laatste feedback ronde en hebben alle feedback doorgevoerd. Wij willen graag de website online gaan zetten en ook de laatste details in orde maken! Hiervoor verzoek ik u, om ons te laten weten welke stappen u wilt maken met betrekking tot de hosting.</p>

<p>Alles m.b.t. de hosting wordt in dit formulier toegelicht, aan het einde kunt u vervolgens uw voorkeur doorgeven. U kunt alles in orde maken via de volgende link: <a href="{{ route('hosting', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('hosting', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

<p>Voor vragen kunt u ons altijd mailen of bellen.</p>

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
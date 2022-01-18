
<p>Beste {{ $project['name'] }},</p>

<p>Wij hebben alle input doorgevoerd op de website. Ik wil u graag verzoeken om alle wijzigingen te bekijken en ons van feedback te voorzien. Wij hebben hiervoor een formulier waarin u duidelijk de feedback per pagina kunt aangeven.</p>

@if ($project['testing_url'])
<p>U kunt de website bekijken op: <a href="{{ $project['testing_url'] }}">{{ $project['testing_url'] }}</a></p>
@endif

<p>Ik wil u graag verzoeken om dit via de volgende link door te geven: <a href="{{ route('first_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('first_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

<p>Voor vragen kunt u ons altijd mailen of bellen. </p>

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
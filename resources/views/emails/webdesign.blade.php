<p>Beste {{ $project['name'] }},</p>

<p>We staan op het punt om te beginnen met het webdesign. Ik wil u verzoeken om via de volgende link ons wat meer informatie te verstrekken over de eisen en wensen van het webdesign.</p>

<p>U kunt de input voor het webdesign hier sturen: <a href="{{ route('web_design', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('web_design', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

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
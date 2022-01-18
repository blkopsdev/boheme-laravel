<p>Beste {{ $project['name'] }},</p>

<p>Wij staan nu op het punt om het webdesign te gaan bouwen! Echter voordat wij hiermee beginnen zou ik nog wat meer input willen zodat ik het fundament alvast goed kan neerzetten. Hiervoor wil ik u verzoeken om via onderstaande link enkele vragen te beantwoorden omtrent de website.</p>

<p>U kunt de vragen via de volgende link beantwoorden: <a href="{{ route('webdesign_dev', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('webdesign_dev', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

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
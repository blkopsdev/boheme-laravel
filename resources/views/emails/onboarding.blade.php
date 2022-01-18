
<p>Beste {{ $project['name'] }},</p>

<p>We staan nu op het punt om aan de website te beginnen! Echter voordat wij beginnen met de website willen wij altijd zorgen dat we op één lijn zitten. Hiervoor wil ik u verzoeken om via onderstaande link enkele vragen te beantwoorden omtrent uw website en hoe u deze voor u ziet.</p>

<p>U kunt de vragen via de volgende link beantwoorden: <a href="{{ route('onboarding', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('onboarding', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

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
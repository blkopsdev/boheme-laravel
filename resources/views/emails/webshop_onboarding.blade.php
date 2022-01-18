<p>Beste {{ $project['name'] }},</p>

<p>Wij staan nu op het punt om de webshop te gaan bouwen! Echter voordat wij beginnen met de webshop willen wij altijd goed in kaart brengen wat uw wensen en eisen zijn voor de website. Hiervoor wil ik u verzoeken om via de onderstaande link enkele vragen te beantwoorden omtrent de webshop.</p>

<p>U kunt de vragen via de volgende link beantwoorden: <a href="{{ route('webshop_onboarding', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('webshop_onboarding', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

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
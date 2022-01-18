
<p>Beste {{ $project['name'] }},</p>

<p>Wij zijn hard aan de slag gegaan met uw logo! In de bijlage vindt u 3 verschillende versies van het logo. Ik wil u verzoeken om één versie van het logo te kiezen en daar verdere feedback op te geven.</p>

<p>U kunt de keuze en feedback van het logo via de volgende link aanleveren: <a href="{{ route('logo_first_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('logo_first_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

<p>Voor vragen kunt u mij altijd mailen of bellen.</p>

<p>Met vriendelijke groet </p>
<p style="margin-bottom: 5px;"><strong>{{ $user['name'] }}</strong></p>
<p style="margin-top: 5px; margin-bottom: 5px;">{{ $user['occupation'] }}</p>
<p style="margin-top: 5px; margin-bottom: 5px;"><em>{{$user['phone']}}</em></p>
<p><img src="{{ asset('uploads/users/' . $user['image_name']) }}" alt="{{ $user['name'] }}" width="100"></p>
@if (strpos($user['website_url'], 'http') !== false) 
  <a href="{{ $user['website_url'] }}">{{$user['website_url']}}</a>
@else
  <a href="http://{{ $user['website_url'] }}">{{$user['website_url']}}</a>
@endif
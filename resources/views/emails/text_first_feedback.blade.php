
<p>Beste {{ $project['name'] }},</p>

<p>Wij zijn hard aan de slag gegaan met de content voor uw website! In de bijlage vindt u een word document met alle teksten. Ik wil u verzoeken om alles goed door te lezen en te kijken of u nog feedback heeft.</p>

<p>U kunt de feedback via de volgende link aanleveren: <a href="{{ route('text_first_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('text_first_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

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



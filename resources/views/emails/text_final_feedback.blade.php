
<p>Beste {{ $project['name'] }},</p>

<p>Wij hebben de feedback zo goed mogelijk verwerkt in de teksten, zie bijlage. Zoals afgesproken heeft u nog één feedback ronde waarin u feedback kunt geven over de teksten. Ik wil u dus vriendelijk verzoeken om de teksten nog een keer goed te analyseren en alle feedback naar ons toe te sturen!</p>

<p>U kunt de laatste feedback via de volgende link naar ons sturen: <a href="{{ route('text_final_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('text_final_feedback', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

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
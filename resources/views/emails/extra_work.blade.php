<p>Beste {{ $project['name'] }},</p>
<p>U heeft aangegeven dat er extra wensen zijn voor de website. Ik wil u graag verzoeken om alle informatie hierover via het onderstaand formulier naar ons toe te sturen. Ik wil u graag verzoeken om een kleine beschrijving naar ons toe te sturen via de onderstaande link. Hier kunt u ook relevante bestanden toevoegen. </p>
<p>U kunt via de volgende link alles aanleveren: <a href="{{ route('extra_work', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('extra_work', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>
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
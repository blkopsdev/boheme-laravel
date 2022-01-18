<p>Beste {{ $project['name'] }},</p>

<p>Ik heb vernomen dat er geen mail vanuit de website wordt verstuurd. Ik heb dit even bekeken en om dit probleem te kunnen verhelpen moet ik de email koppelen aan de website. Hierdoor worden voortaan alle mails vanuit de website verstuurd vanuit uw mail.</p>

<p>Ik wil u graag verzoeken om de inloggegevens van uw mail via een beveiligd formulier naar ons toe te sturen zodat ik dit probleem snel kan verhelpen.</p>

<p>U kunt alle informatie via de volgende link aanleveren: <a href="{{ route('mail_error', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('mail_error', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>

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
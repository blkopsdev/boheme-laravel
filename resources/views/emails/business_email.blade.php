
<p>Beste {{ $project['name'] }},</p>
<p>Om de zakelijke mail in te gaan stellen heb ik wat informatie nodig van jullie kant. Ik wil jullie verzoeken om alle informatie aan te leveren via de volgende link: <a href="{{ route('business_email', ['id' => $form['id'], 'token' => $form['token']]) }}">{{ route('business_email', ['id' => $form['id'], 'token' => $form['token']]) }}</a></p>
<p>Mochten jullie hier nog vragen over hebben kunnen jullie ons altijd telefonisch bereiken!</p>
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
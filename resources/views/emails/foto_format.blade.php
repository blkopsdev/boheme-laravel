
<p>Beste {{ $project['name'] }},</p>
<p>Met het invoeren van de foto’s ben ik erachter gekomen dat de aangeleverde foto’s een te klein formaat hebben en dus van onscherpe kwaliteit zijn.</p>
<p>Ik wil u graag verzoeken om ons foto’s toe te sturen van hogere kwaliteit (voorkeursformaat: 1900x1200 px).</p>
<p>Ik kijk uit naar uw reactie!</p>
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
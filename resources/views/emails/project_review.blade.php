<p>Beste {{ $project['name'] }},</p>
<p>Bedankt voor de tot nu toe prettige samenwerking! Wij zijn erg tevreden met het uiteindelijke resultaat en wij hopen uiteraard dat dit ook wederzijds is.</p>
<p>Daarom vragen wij of u één minuut de tijd wilt nemen om een review achter te laten. Wij geloven namelijk sterk in tevreden klanten en willen dit ook met trots tonen.</p>
<p>Wij streven ernaar om beoordelingen te krijgen op twee verschillende plaatsen: Google en TrustPilot, zie de linkjes hieronder. Wij willen u alvast erg bedanken voor de moeite en hopen de samenwerking op goede voet voort te zetten.</p>
<p>Google: <a href="https://bit.ly/2IQSeZY" target="_blank">https://bit.ly/2IQSeZY </a></p>
<p>Trustpilot: <a href="https://bit.ly/3lRMhtO" target="_blank">https://bit.ly/3lRMhtO</a></p>
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
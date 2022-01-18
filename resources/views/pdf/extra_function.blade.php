<html>
<head>
  <style>
    @page { margin: 100px 25px; }
    
    header { position: fixed; top: -60px; left: 0px; right: 0px; text-align:right; }
    footer {position: fixed; bottom: -90px; left: 0px; right: 0px; height: 50px; text-align:center; border-top: 1px solid blue; width: 100%;padding-top: 10px;}
    p {font-size: 16px;}
    .page-number:before {
      content: "Page " counter(page);
    }
    p.next {
      page-break-after: always;
    }
    h3 {
      font-weight: 500;
    }
    .images {
      display: block;
      width: 100%;
      float: left
    }
  </style>
</head>
<body style="font-family: sans-serif;">
  <header><img src="{{asset('assets/img/logo.png')}}" width="150" alt=""></header>
  <footer><span style="float:right">Copyright IQ Script ©</span></footer>
  <main>
    <div class="content">
      <div class="container-fluid">
        <h1><strong>Website </strong>| Extra features Website</h1>
        <p><strong>Company</strong>: {{$data->project->company_name}}</p>
        <p><strong>Testserver URL</strong>:  <a href="{{$data->project->testing_url}}" target="_blank">{{$data->project->testing_url}}</a></p><br><br>
        <p><strong>WP Access</strong></p>
        <p>User: Developer</p>
        <p>Pass: Dev123Sup123!</p>
        <br><br>
        <p>Use Google Translate in order to understand the feedback!</p>
        <br><br>
        @for ($i = 0; $i < count(json_decode($data->description)); $i++)
          <h2><strong>Summary extra functionality {{ $i + 1 }}</strong></h2>
          <p>{{ json_decode($data->description)[$i] }}</p>
          <br><br>
          @if ($data->file($i))
          <h3><strong>Attached files: </strong></h3>
          <a href="{{ asset('uploads/' . $data->file($i)->media_name) }}" target="_blank">{{ asset('uploads/' . $data->file($i)->media_name) }}</a>
          @endif
          <br><br>
          @if (countArray(json_decode($data->examples)[$i]) > 0)
          <h3><strong>Existing example functionality:</strong></h3>
          <ul>
            @foreach (json_decode($data->examples)[$i] as $item)
              @if ($item)
              <li>{{ $item }}</li>
              @endif
            @endforeach
          </ul>
          <br><br>
          @endif
          @if (countArray(json_decode($data->login_urls)[$i]) > 0 && countArray(json_decode($data->login_emails)[$i]) > 0 && countArray(json_decode($data->login_passwords)[$i]) > 0)
          <h3><strong>Login acces (optional):</strong></h3>
          <ul>
            @for ($j = 0; $j < count(json_decode($data->login_urls)[$i]); $j++)
              @if (json_decode($data->login_urls)[$i][$j] && json_decode($data->login_emails)[$i][$j] && json_decode($data->login_passwords)[$i][$j])
              <li> Login {{ $j + 1 }}:
                <ul>
                  <li>URL: {{ json_decode($data->login_urls)[$i][$j] }}</li>
                  <li>Username / email: {{ json_decode($data->login_emails)[$i][$j] }}</li>
                  <li>Password: {{ json_decode($data->login_passwords)[$i][$j] }}</li>
                </ul>
              </li>            
              @endif
            @endfor
          </ul>
          <br><br>
          @endif
        @endfor
      </div>
    </div>
  </main>
</body>
</html>
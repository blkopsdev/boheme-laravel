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
        <h1><strong>Website </strong>| Feedback {{ $status == 'first_feedback' ? 'first' : 'final'}} version</h1>
        <p><strong>Company</strong>: {{$project->company_name}}</p>
        <p><strong>Testserver URL</strong>:  <a href="{{$project->testing_url}}" target="_blank">{{$project->testing_url}}</a></p><br>
        <p><strong>WP Access:</strong></p>
        <p>URL: /iqscript</p>
        <p>User: support</p>
        <p>Password: Test20.000_@@!</p>

        <p>Use Google Translate in order to understand the feedback!</p>
        <br><br>
        
        @php
            $pages = count(json_decode($data->page_names));
            $page_names = json_decode($data->page_names);
            $page_feedbacks = json_decode($data->page_feedbacks);
        @endphp
        @for ($i = 0; $i < $pages; $i++)
        <h3><strong>Page {{ $i + 1 }}: </strong> {{ $page_names[$i] }}</h3>
        <h4><strong>Feedback</strong></h4>
        <p>{!! $page_feedbacks[$i] !!}</p>
        <br>
        @if ($data->files($i)->count() > 0)
        <h4><strong>Attached files:</strong></h4>
        <ul>
          @foreach ($data->files($i) as $file)
          <li>
            <a href="{{ asset('uploads/' . $file->media_name) }}" target="_blank">{{ asset('uploads/' . $file->media_name) }}</a>
          </li>
          @endforeach
        </ul>
        @endif
        <br><br>
        @endfor
      </div>
    </div>
  </main>
</body>
</html>
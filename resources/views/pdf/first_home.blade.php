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
        <h1><strong>Website | </strong>Feedback first version webdesign</h1>
        
        <p><span><strong>Company name:</strong> {{$data->project->company_name}}</span>
        </p>
        <p><strong>Testserver URL: </strong> {{ $data->project->testing_url }}</p><br>
        <p><strong>WP Access:</strong></p>
        <p>User: Developer</p>
        <p>Pass: Dev123Sup123!</p><br>
        
        <p><strong>Use Google Tranlslate in order to understand the answers provided by the client!</strong></p>
        <br><br>

        <h3><strong>1. Feedback of the client:</strong></h3>
        <p>{{$data->feedback}}</p><br>
        <h3><strong>2. Attached files:</strong></h3>
        @if ($data->files()->count() > 0)
          @foreach ($data->files() as $file)
            <a href="{{ asset('uploads/' . $file->media_name) }}" target="_blank">{{ asset('uploads/' . $file->media_name) }}</a><br>
          @endforeach
        @endif
      </div>
    </div>
  </main>
</body>
</html>
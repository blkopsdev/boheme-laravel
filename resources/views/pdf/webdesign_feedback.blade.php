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
        <h1><strong>Website | </strong> {{ $status == 'webdesign_version_1' ? 'Webdesign First Feedback' : 'Webdesign Final Feedback' }}</h1>
        <p><span><strong>Company name:</strong> {{$data->project->company_name}}</span>
        </p>
        <p><strong>Client name: </strong>{{ $data->project->name }}</p>
        <br><br>
        <p><em>Please note: If needed you can use Google Translate to translate the questions given by the client:</em></p><br><br>
        <h3><strong>1. Feedback of the client:</strong></h3>
        <p>{!! $data->feedback !!}</p><br>
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
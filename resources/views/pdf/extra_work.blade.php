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

        <p>Use Google Translate in order to understand the feedback!</p><br>
        
        <h3><strong>Summary extra functionalities</strong></h3>
        <p>{{ $data->description }}</p>
        @if ($data->files()->count() > 0)
        <h3><strong>Attached files:</strong></h3>
        @foreach (json_decode($data->files()) as $item)
          <a href="{{ asset('uploads/' . $item->media_name) }}" target="_blank">{{ asset('uploads/' . $item->media_name) }}</a> <br>
        @endforeach            
        @endif
      </div>
    </div>
  </main>
</body>
</html>
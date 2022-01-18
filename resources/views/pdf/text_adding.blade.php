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
    h2 {
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
        <h1><strong>Website :</strong> Text adding</h1>
        <p><strong>Company:</strong> {{$data->project->company_name}}</p>
        <p><strong>Testserver URL</strong>:  <a href="{{$data->project->testing_url}}" target="_blank">{{$data->project->testing_url}}</a></p><br><br>
        <p><strong>WP Access</strong></p>
        <p>URL: /iqscript</p>
        <p>User: support</p>
        <p>Password: Test20.000_@@!</p>
        <br><br>
        <p><strong>The goal of this job:</strong> The goal of this job is to create a first version website/webshop which we can send to client. Please make sure you will change/delete all dummy content to the client's content. If you miss any content let me know!</p>
        <br><br>
        <p><strong>Use Google Translate in order to understand the answers provided by the client!</strong></p><br><br>
        <h2><strong>1. Text delivery:  </strong></h2>
        <p><strong>Attached file: </strong> 
          @if ($data->file('text_file'))
          <a href="{{asset('uploads/' . $data->file('text_file')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('text_file')->media_name)}}</a>
          @endif
        </p>
        <p><strong>Comments:</strong></p>
        <p>{{ $data->direct_text ? $data->direct_text : '' }}</p> 
        <br><br>
        <h2><strong>2. Unique Selling points: </strong></h2>
        <p>Integrate the following USP’s in the website (you can add these in the icon boxes in the demo). You can use Google Translate to understand the points better:</p>
        <ol>
          @foreach (json_decode($data->usp) as $item)
            @if ($item)
            <li>{{ $item }}</li>
            @endif
          @endforeach
        </ol>
        <br><br>
        <h2><strong>3. Titles that can be used for the website:</strong></h2>
        <p>We have seen that sometimes the client delivers only text alineas with titles. You can use these as inspiration. Again use Google translate to understand the titles and modify if needed.</p>
        <ol>
          @foreach (json_decode($data->titles) as $item)
            @if ($item)
            <li>{{ $item }}</li>
            @endif
          @endforeach
        </ol>
        <br><br>
        <h2><strong>4. Team section: {{ $data->team == 1 ? 'Yes': 'No'}}</strong></h2>
        <p>If the client wants a team section, please integrate this in the website.</p>
        <br>
        @if ($data->team == 1)
        <p><strong>Notes: </strong> {{ $data->team_text }}</p>
        <p><strong>Images of team:</strong> 
          @if ($data->file('team_photo'))
          <a href="{{asset('uploads/' . $data->file('team_photo')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('team_photo')->media_name)}}</a>
          @endif
        </p>
        <p><strong>Details of team:</strong> 
          @if ($data->file('team_doc'))
          <a href="{{asset('uploads/' . $data->file('team_doc')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('team_doc')->media_name)}}</a>
          @endif
        </p>
        @if ($data->team_file_later == 1)
          <p>Answer of the client: Ik lever de bestanden later aan, gebruik voor nu voorbeeld content</p>
        @endif
        @endif
        <br><br>
        <h2><strong>5. Integration of other files: </strong></h2>
        <p>Sometimes the client also needs us to add pages in the footer like Terms and conditions or disclaimer. The clients will add the files here for these pages. Please add these files as a PDF link in the footer.</p>
        @if ($data->file('terms_file'))
        <p><strong>Algemene Voorwaarden (Terms and conditions):</strong></p>
        <a href="{{asset('uploads/' . $data->file('terms_file')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('terms_file')->media_name)}}</a>
        @endif
        @if ($data->file('other_file')->count() > 0)
        <p><strong>Other files that need to be added:</strong></p>
          @foreach ($data->file('other_file') as $file)
            @if ($file != null)
            <a href="{{asset('uploads/' . $file->media_name)}}" target="_blank">{{asset('uploads/' . $file->media_name)}}</a><br>
            @endif
          @endforeach
        @endif
        @if ($data->other_comment)
        <p><strong>Note:</strong></p>
        <p>{{$data->other_comment }}</p>
        @endif
        <br><br>
        <h2><strong>6. Review section: {{ $data->review == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a review section, please integrate this in the website.</p>
        @if ($data->review == 1)
        <p><strong>Link to reviews:</strong> <a href="{{ $data->review_link }}" target="_blank">{{ $data->review_link }}</a></p>
        @if ($data->file('review_file'))
        <p>
          <strong>Attached file:</strong> 
          <a href="{{asset('uploads/' . $data->file('review_file')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('review_file')->media_name)}}</a>
        </p>
        @endif
        <br>
        @if ($data->review_file_later == 1)
        <p>Answer of the client: Ik lever de bestanden later aan, gebruik voor nu voorbeeld content</p>
        @endif
        @endif
        <br><br>
        <h2><strong>7. Portfolio section: {{ $data->portfolio == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>When the client wants a portfolio section. Please go to the content that is delivered and copy these items to the website.</p>
        @if ($data->portfolio == 1)
        <p><strong>Link to portfolio:</strong> <a href="{{ $data->portfolio_link }}" target="_blank">{{ $data->portfolio_link }}</a></p>
        @if ($data->file('portfolio_file'))
        <p>
          <strong>Attached file:</strong> 
          <a href="{{asset('uploads/' . $data->file('portfolio_file')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('portfolio_file')->media_name)}}</a>
        </p>
        @endif
        <br>
        @if ($data->portfolio_file_later == 1)
          <p>Answer of the client: Ik lever de bestanden later aan, gebruik voor nu voorbeeld content</p>
        @endif
        @endif
        <br><br>
        <h2><strong>8. Blog section/page: {{ $data->blog == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>When the client wants a portfolio section. Please go to the content that is delivered and copy these items to the website.</p>
        @if ($data->blog == 1)
        <p><strong>Link to blog:</strong> <a href="{{ $data->blog_link }}" target="_blank">{{ $data->blog_link }}</a></p>
        @if ($data->file('blog_file'))
        <p>
          <strong>Attached file:</strong> 
          <a href="{{asset('uploads/' . $data->file('blog_file')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('blog_file')->media_name)}}</a>
        </p>
        @endif
        <br>
        @if ($data->blog_file_later == 1)
          <p>Answer of the client: Ik lever de bestanden later aan, gebruik voor nu voorbeeld content</p>
        @endif
        @endif
        <br><br>
        <h2><strong>9. Nieuwsbrief subscription section: {{ $data->newsletter == 1 ? 'Yes' : 'No' }}</strong></h2>
        <p>If the client wants a mailing list subscription section. Please add this, you can add this very easy in the page using the block library.</p>
        <br><br>
        <h2><strong>10. Images for the website:</strong></h2>
        @if ($data->dev_image == 1)
        <p>Ik heb alle foto's via jullie fotodatabase uitgezocht</p>
        @else
        <p>Please download all the images and make sure all the current images are replaced! Sometimes you can also use images 2 times when the client does not deliver enough images.</p>
        @if ($data->file('images_file'))
        <p>
          <strong>Attached file:</strong> 
          <a href="{{asset('uploads/' . $data->file('images_file')->media_name)}}" target="_blank">{{asset('uploads/' . $data->file('images_file')->media_name)}}</a>
        </p>
        @endif
        <p><strong>Note: </strong></p>
        <p>{{ $data->explanation }}</p>
        @endif
      </div>
    </div>
  </main>
</body>
</html>
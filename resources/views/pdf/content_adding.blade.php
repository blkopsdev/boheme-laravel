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
    h1, h2, h2, h4, h5 {
      font-family: sans-serif !important;
    }
  </style>
</head>
<body style="font-family: sans-serif;">
  <header><img src="{{asset('assets/img/logo.png')}}" width="150" alt=""></header>
  <footer><span style="float:right">Copyright IQ Script ©</span></footer>
  <main>
    <div class="content">
      <div class="container-fluid">
        <h1><strong>Webshop | </strong>Content adding</h1>
        <br>
        <p><strong>The goal of this job:</strong> The goal of this job is to create a first version website/webshop which we can send to client. Please make sure you will change/delete all dummy content to the client's content. If you miss any content, please let me know!</p>
        <p>Please add the products:</p>
        @if ($data->file('products_file'))
        <p><strong>Products details: </strong><a href="{{ asset('uploads/' . $data->file('products_file')->media_name) }}">{{ asset('uploads/' . $data->file('products_file')->media_name) }}</a></p>
        @endif
        @if ($data->file('products_image'))
        <p><strong>Products images: </strong><a href="{{ asset('uploads/' . $data->file('products_image')->media_name) }}">{{ asset('uploads/' . $data->file('products_image')->media_name) }}</a></p>
        @endif
        <p><strong>Note:</strong></p>
        <p>{{ $data->description }}</p>
        <br><br>
        <p>Also please add the text delivered by client:</p>
        @for ($i = 0; $i < count(json_decode($data->pages)); $i++)
          @if (json_decode($data->pages)[$i])
            <p><strong>Page {{ $i + 1 }}:</strong> {{ json_decode($data->pages)[$i] }}</p>
            <p><strong>Notes of the client:</strong></p>
            <p>{{ isset(json_decode($data->page_descriptions)[$i]) ? json_decode($data->page_descriptions)[$i] : '' }}</p>
            @if ($data->files($i)->count() > 0)
            <p><strong>Attached files:</strong></p>
            <ul>
              @foreach ($data->files($i) as $file)
                <li><a href="{{ asset('uploads/' . $file->media_name) }}">{{ asset('uploads/' . $file->media_name) }}</a></li>
              @endforeach
            </ul>
            @endif
            <br>
          @endif
        @endfor
        <br><br>
        @if ($data->website_image_source == 1 || $data->file('website_image') || $data->website_image_comment)
        <p>When you add the text also please integrate the images provided by the client:</p>
          @if ($data->website_image_source == 1)
            <p>Ik heb alle foto's via jullie fotodatabase uitgezocht</p>
          @else
            @if ($data->file('website_image'))
            <p><strong>Attached file:</strong> <a href="{{asset('uploads/' . $data->file('website_image')->media_name)}}" target="_blank">{{$data->file('website_image')->media_name}}</a></p>
            @endif
          @endif
          @if ($data->website_image_comment)
          <p><strong>Note: </strong></p>
          <p>{{ $data->website_image_comment }}</p>
          @endif
        <br><br>
        @endif
        <p>Please integrate the following USP's delivered by the client (at the product page etc.)</p>
        <ol>
          @foreach (json_decode($data->usps) as $item)
            @if ($item)
            <li>{{ $item }}</li>
            @endif
          @endforeach
        </ol>
        <br><br>
        @if ($data->file('terms_file'))
        <p>Please integrate the following terms & conditions in the website:</p>
        <a href="{{asset('uploads/' . $data->file('terms_file')->media_name)}}" target="_blank">{{$data->file('terms_file')->media_name}}</a>
        <br><br>
        @endif
        
        @if ($data->file('other_file')->count() > 0)
        <p><strong>Other files:</strong></p>
        <p>The client also asked me to integrate these files in the website.</p>
        <p>Please note: these are just static pages with the text placed. Also please integrate these in the footer widget menu!</p>
        <ul>
          @foreach ($data->file('other_file') as $file)
            <li><a href="{{asset('uploads/' . $file->media_name)}}" target="_blank">{{$file->media_name}}</a></li>
          @endforeach
        </ul>
        @endif
        <p>Notes of the client:</p>
        <p>{{$data->other_comment}}</p>
        <br><br>
        @if ($data->review == 1)
          <p>Add a review section for the website: </p>
          @if ($data->review_link)
          <p><strong>Link to reviews:</strong> <a href="{{ $data->review_link }}" target="_blank">{{ $data->review_link }}</a></p>
          @endif
          @if ($data->file('review_file'))
          <p><strong>Attached file:</strong> <a href="{{asset('uploads/' . $data->review_file)->media_name}}" target="_blank">{{$data->review_file->media_name}}</a></p><br>
          @endif          
          @if ($data->review_file_later == 1)
          <p>Answer of the client: Ik lever de bestanden later aan, gebruik voor nu voorbeeld content</p>
          @endif
          <br><br>
        @endif
        @if ($data->newsletter == 1)
          <p>Add a newsletter subscribe section in the website:</p>
          <p><em>Please note: you can find this very easy in the blocks provided by the theme.</em></p>
          <br><br>
        @endif
        <p>Lastly please install the plugin: Mollie payments for Woocommerce and integrate the following keys:</p>
        <p><strong>Live Key:</strong> {{ $data->payment_live_key }}</p>
        <p><strong>Test Key:</strong> {{ $data->payment_test_key }}</p>
      </div>
    </div>
  </main>
</body>
</html>
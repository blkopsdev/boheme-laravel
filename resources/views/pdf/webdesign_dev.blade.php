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
        <h1><strong>Website | Webdesign Development</strong></h1>
        <br><br>
        <p><strong>Company</strong>: {{$data->project->company_name}}</p>
        <p><strong>Client name</strong>: {{$data->project->name}}</p>
        <br><br>
        <p><em>Please note: If needed you can use Google Translate to translate the questions given by the client:</em></p><br><br>
        <p>Please go to this link: <a href="https://docs.google.com/spreadsheets/u/1/d/1wMhRNTDWITpInFXPlHMUTyB9y9o1oP0YekBoxn6f8ys/edit#gid=0">HERE</a></p>
        <br>
        <p>Choose here a free test server and login using: </p>
        <p><strong>User:</strong> support</p>
        <p><strong>Password:</strong> Test20.000!</p>
        <br>
        <p>Please install this theme:</p>
        <p><a href="http://portal.iqscript.nl/wp-content/uploads/2020/07/themeforest-oKBghXC8-total-responsive-multipurpose-wordpress-theme-wordpress-theme.zip">Theme link</a></p>
        <br><br>
        <h2><strong>1. Sitemap: </strong> </h2>
        <ul>
          <li>Home</li>
          @if ($data->menu_item_1)
          <li>
            {{$data->menu_item_1}}
            @if ($data->submenu_item_1 && $data->submenu_item_1 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_1) as $sub1_item)
                    @if ($sub1_item)
                    <li>{{ $sub1_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_2)
          <li>
            {{$data->menu_item_2}}
            @if ($data->submenu_item_2 && $data->submenu_item_2 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_2) as $sub2_item)
                    @if ($sub2_item)
                    <li>{{ $sub2_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_3)
          <li>
            {{$data->menu_item_3}}
            @if ($data->submenu_item_3 && $data->submenu_item_3 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_3) as $sub3_item)
                    @if ($sub3_item)
                    <li>{{ $sub3_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_4)
          <li>
            {{$data->menu_item_4}}
            @if ($data->submenu_item_4 && $data->submenu_item_4 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_4) as $sub4_item)
                    @if ($sub4_item)
                    <li>{{ $sub4_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_5)
          <li>
            {{$data->menu_item_5}}
            @if ($data->submenu_item_5 && $data->submenu_item_5 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_5) as $sub5_item)
                    @if ($sub5_item)
                    <li>{{ $sub5_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          @if ($data->menu_item_6)
          <li>
            {{$data->menu_item_6}}
            @if ($data->submenu_item_6 && $data->submenu_item_6 != 'null')
              <ul>
                @foreach (json_decode($data->submenu_item_6) as $sub6_item)
                    @if ($sub6_item)
                    <li>{{ $sub6_item }}</li>     
                    @endif
                @endforeach
              </ul>
            @endif
          </li>
          @endif
          <li>Contact</li>
        </ul>
        @if ($data->menu_comment)
        <br>
        <p>Note of client: {{ $data->menu_comment }}</p>
        @endif
        <br>
        <p>Please setup this sitemap. Make sure you create the pages already! You can use existing layouts of other pages.</p>
        <br><br>
        <h2><strong>2. Social media:</strong></h2>
        <p><em>Please add the folowing social media connections to the website</em></p>
        @if ($data->social_links && $data->social_links != 'null')
         <ul>
            @foreach (json_decode($data->social_links) as $link)
            @if ($link)
                @if (strpos($link, 'http') !== false) 
                <li><a href="{{ $link }}" target="_blank">{{$link}}</a></li>
                @else
                <li><a href="http://{{ $link }}" target="_blank">{{$link}}</a></li>
                @endif
            @endif
            @endforeach
         </ul>
        @endif
        <br><br>
        <h2><strong>3. Webdesign</strong></h2>
        <p>Please build the following webdesign:</p>
        @if ($file->count()>0)
          @foreach ($file as $image)
          <a href="{{ asset('uploads/' . $image->media_name) }}">{{ asset('uploads/' . $image->media_name) }}</a>
          @endforeach
        @endif
      </div>
    </div>
  </main>
</body>
</html>
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
        <h1><strong>Logo design job:</strong></h1>
        <p><strong>Please make sure you will deliver 3 different logos in the style the client likes.</strong></p>
        <p><strong>Also do some research about the niche (see question 1) and what kind of logos are used there.</strong></p> <br>
        <p><span><strong>Company name:</strong> {{$data->company_name}}</span>
        </p>
        <p><span><strong>Slogan:</strong> {{$data->slogan? $data->slogan: ''}}</span></p>
        
        <p><em>Please note: If needed you can use Google Translate to translate the questions given by the client:</em></p><br><br>

        <h3><strong>1. What services/products do you offer?:</strong></h3>
        <p>{{$data->niche}}</p>
        <br><br>
        <h3><strong>2. What does your logo need to look like?:</strong></h3>
        @if($data->types)
        <p>{{implode(', ', json_decode($data->types))}}</p>
        @endif
        <br><br>
        <h3><strong>3. Which logo do you prefer more (retro vs. minimalistic):</strong></h3>
        <p><em>Please note: the logo DOESN'T need to look like this! Only you can see the style the client prefers.</em></p>
        @if($data->favorite_logo_1)
        <br><br>
        <div class="images">
          @if ($data->favorite_logo_1 == 1)
          <img src="{{ asset('assets/img/pdf/favorite-logo-1-0-selected.png') }}" width="240" alt="">
          <img src="{{ asset('assets/img/pdf/favorite-logo-1-1.png') }}" width="240" alt="">
          @else
          <img src="{{ asset('assets/img/pdf/favorite-logo-1-0.png') }}" width="240" alt="">
          <img src="{{ asset('assets/img/pdf/favorite-logo-1-1-selected.png') }}" width="240" alt="">
          @endif
        </div>
        @endif
        <br>
        <h3><strong>4. Which logo do you prefer more (Hand-drawn vs. 3D logo):</strong></h3>
        <p><em>Please note: the logo DOESN'T need to look like this! Only you can see the style the client prefers.</em></p>
        @if($data->favorite_logo_2)
        <br><br>
        <div class="images">
          @if ($data->favorite_logo_2 == 1)
          <img src="{{ asset('assets/img/pdf/favorite-logo-2-0-selected.png') }}" width="240" alt="">
          <img src="{{ asset('assets/img/pdf/favorite-logo-2-1.png') }}" width="240" alt="">
          @else
          <img src="{{ asset('assets/img/pdf/favorite-logo-2-0.png') }}" width="240" alt="">
          <img src="{{ asset('assets/img/pdf/favorite-logo-2-1-selected.png') }}" width="240" alt="">
          @endif
        </div>
        @endif
        <br>
        <h3><strong>5. Which logo do you prefer more (Minimalistic vs. Signature):</strong></h3>
        <p><em>Please note: the logo DOESN'T need to look like this! Only you can see the style the client prefers.</em></p>
        @if($data->favorite_logo_3)
        <br><br>
        <div class="images">
          @if ($data->favorite_logo_3 == 1)
          <img src="{{ asset('assets/img/pdf/favorite-logo-3-0-selected.png') }}" width="240" alt="">
          <img src="{{ asset('assets/img/pdf/favorite-logo-3-1.png') }}" width="240" alt="">
          @else
          <img src="{{ asset('assets/img/pdf/favorite-logo-3-0.png') }}" width="240" alt="">
          <img src="{{ asset('assets/img/pdf/favorite-logo-3-1-selected.png') }}" width="240" alt="">
          @endif
        </div>
        @endif
        <br>
        <h3><strong>6. Which logo do you prefer more(Signature vs. Iconic logo):</strong></h3>
        <p><em>Please note: the logo DOESN'T need to look like this! Only you can see the style the client prefers.</em></p>
        @if($data->favorite_logo_4)
        <br><br>
        <div class="images">
          @if ($data->favorite_logo_4 == 1)
          <img src="{{ asset('assets/img/pdf/favorite-logo-4-0-selected.png') }}" width="240" alt="">
          <img src="{{ asset('assets/img/pdf/favorite-logo-4-1.png') }}" width="240" alt="">
          @else
          <img src="{{ asset('assets/img/pdf/favorite-logo-4-0.png') }}" width="240" alt="">
          <img src="{{ asset('assets/img/pdf/favorite-logo-4-1-selected.png') }}" width="240" alt="">
          @endif
        </div>
        @endif
        <br>
        <h3><strong>7. For which purpose you want to use the logo?</strong></h3>
        <p>{{$data->purpose?implode(', ', json_decode($data->purpose)):''}}</p>
        <p><em>Please note: look at the which files you need to deliver. This is different for each purpose:</em></p>
        <ul>
          <li><strong>Website</strong> = .ai , transparent dark logo (light background), transparent light</li>
          <li><strong>Visiting cards</strong> = .ai , .svg & .png files</li>
          <li><strong>Social media</strong> = make sure you add the sizes of social media <strong>like a square formats to the logo</strong></li>
        </ul>
        <br><br>
        <h3><strong>8. Colors for the logo:</strong></h3>
        @if ($data->logo_color == 0)
        <p><strong>Main color:</strong>{{$data->main_color}}</p>
        <p><strong>Sub color:</strong>{{$data->sub_color_1}}</p>
        <p><strong>Sub color 2:</strong>{{$data->sub_color_2}}</p>
        @else
        <p>@lang('form.dont_know_logo')</p>
        @endif
        @if ($data->reference_color && media_file($data->reference_color))
        <p><strong>Files for reference of the color: </strong></p>
        <a href="{{ asset('uploads/' . media_file($data->reference_color)->media_name) }}">{{ asset('uploads/' . media_file($data->reference_color)->media_name) }}</a>
        @endif
        <br><br>
        <h3><strong>9. Examples of logo's for inspiration: </strong></h3>
        <p>{{ $data->inspiration_logo ? $data->inspiration_logo : '' }}</p>
        @if ($logo_files->count() > 0)
          @foreach (json_decode($logo_files) as $item)
            @if ($item)
              <p><a href="{{ asset('uploads/' . $item->media_name) }}" target="_blank">{{ $item->media_name }}</a></p>
            @endif
          @endforeach
        @endif
      </div>
    </div>
  </main>
</body>
</html>
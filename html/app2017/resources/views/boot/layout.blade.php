<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ config('app.name', 'Suhov') }}</title>

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="{{ asset('/') }}css/main.css" />
    <link type="text/css" rel="stylesheet" href="{{ asset('/') }}css/main-responsive.min.css" />
    <link type="text/css" rel="stylesheet" href="{{ asset('/') }}fonts/clip-font.min.css" />
    <link type="text/css" rel="stylesheet" id="skin_color" href="{{ asset('/') }}css/theme/light.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="padding-top: 48px;" >
        @include("boot.nav_top") 
        <div class="main-container">        
            <div class="navbar-content">
                @include("boot.nav_left")
            </div>
            <div class="main-content" style="padding: 12px">  
                <ol class="breadcrumb" style="display: none">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Library</a></li>
                    <li class="active">Data</li>
                </ol>  
                @if (Session::has('message'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning!</strong> {{ Session::get('message') }} 
                </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')                
            </div>
        </div>   
            <!-- start: FOOTER -->
    <div class="navbar  navbar-fixed-bottom blockquote-reverse">
        
            <script>
                //document.write(new Date().getFullYear())
            </script> 
            {{--date_default_timezone_get()--}}
            <span class="go-top"> 
                &copy; {{date('H:i', time())}}
                <i class="clip-chevron-up"></i>
            </span>        
    </div>
    <!-- end: FOOTER -->            
        
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}js/perfect-scrollbar.jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="{{ asset('/') }}js/bootstrap.min.js"></script>      
    <script type="text/javascript" src="{{ asset('/') }}js/main.js"></script>
    <!-- pushed from other views -->
    @stack('scripts')
    <!-- -->
    <script>
        jQuery(document).ready(function() {
            Main.init();           
        });
    </script>    
  </body>
</html>
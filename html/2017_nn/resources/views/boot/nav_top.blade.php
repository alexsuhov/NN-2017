<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" >
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Suhov') }}</a>      
        <!--
        <a class="" href="{{ url('/force') }}">force</a> 
        <input type="checkbox" disabled="" />
        -->
    </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1" >        
        <p class="navbar-text visible-lg visible-md" style="width: 10%"> </p>
        <ul class="rcadm-nav nav navbar-nav">
            <li class="rcadm <?=(Route::currentRouteName()=='rcadm.create')?'here':""?>">
                <a href="{{ route('rcadm.create') }}">Data Entry
                    <span class="sr-only">(current)</span>
                </a>
            </li>        
            <li class="dropdown rcadm <?=(Route::currentRouteName()=='pachet.index')?'here':""?>"">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestiune Pachete <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('pachet.index') }}">Pachete</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ url('list/batch3') }}">Scan Proces 3</a></li>
                    <li><a href="{{ url('list/batch1') }}">Scan Proces 1</a></li>                                         
                    <li><a href="{{url('F3_error')}}">Erori Proces 1</a></li>
                </ul>
            </li>     
            <li>
                <form class="navbar-form navbar-left" action="{{ url('list/search') }}">
                    <div class="form-group">
                        <input max="99999999" title="Cauta" type="number" class="form-control" placeholder="Cauta" name="search" value="<?=isset($_GET['search'])?$_GET['search']:''?>">
                    </div>                   
                    <!-- Split button -->
                    <div class="btn-group">
                        <a type="submit" class="btn btn-default" name="cif">Dupa:</a>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">         
                            <li><button type="submit" class="btn btn-default" name="cif" value="1">CIF</button></li>
                            <li><button type="submit" class="btn btn-default" name="id_aplicatie" value="1">ID aplicatie</button></li> 
                            <li><button type="submit" class="btn btn-default" name="flux3" value="1">Cod de bare</button></li>                        
                        </ul>
                    </div>
                </form>        
            </li>
            <li class="rcadm hidden-sm"><a href="#">Retrive</a></li>
        </ul>
        
        
        <ul class="nav navbar-nav navbar-right" >
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    User <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">                                            
                            <i class="clip-exit"></i> Logout
                        </a>                                    
                        <form id="logout-form" action="<?=url('/logout')?>" method="POST" style="display: none;">
                            {{ csrf_field() }}                                    
                        </form>
                    </li>
                </ul>
            </li>
        </ul>        
    </div><!-- /.navbar-collapse -->
        
    
  </div><!-- /.container-fluid -->
</nav>


<style>                
    li.rcadm   
    {                      
       
        font-size: 11px;
        width:136px;            
        background:url(<?=asset('/')?>images/link_top.bmp) no-repeat top left;            
    }       
    li.rcadm.here   
    {                              
        background:url(<?=asset('/')?>images/link_top_active.bmp) no-repeat top left;            
    } 
   
    .navbar
    {            
        margin-bottom: 2px;             
    }
</style>
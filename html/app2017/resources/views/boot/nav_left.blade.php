            <!-- start: SIDEBAR -->
            <div class="main-navigation navbar-collapse collapse">
                <!-- start: MAIN MENU TOGGLER BUTTON 
                {{Route::currentRouteName()}} -->
                <div class="navigation-toggler">
                    <i class="clip-chevron-left"></i>
                    <i class="clip-chevron-right"></i>
                </div>
                <!-- end: MAIN MENU TOGGLER BUTTON -->
                <ul class="main-navigation-menu">                                                                            
                    <li class="active open" >                        
                        <a href="javascript:void(0)">
                            <i class="clip-screen"></i>                            
                            <span class="title"> Manage: </span><i class="icon-arrow"></i>          
                            <span class="selected"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="active" >
                                <a href="{{route('user.index')}}">
                                    <span class="title"> Users </span>                                    
                                </a>
                            </li>
                            <li>
                                <a href="{{route('role.index')}}">
                                    <span class="title"> Roles </span>
                                </a>
                            </li>                                                        
                            <li>
                                <a href="{{route('field.index')}}">
                                    <span class="title"> Fields </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- end: SIDEBAR --> 

    
    
    


    

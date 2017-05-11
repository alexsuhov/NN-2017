@inject('users', 'App\User')
@inject('roles', 'App\Role')

{{ link_to_route('role.create' ,'Create', "" , ['class' => 'btn btn-xs btn-primary ']) }}
{{ link_to_route('role.create' ,'Create Account', "" , ['class' => 'btn btn-xs btn-info ']) }}

<table class="table table-striped table-condensed">
    <thead>
        <tr>
            <th>Actions</th>
            <th>User</th>
            <th>Email</th>
            <th>Roles</th>       
        </tr>    
    </thead>
    @foreach ( $users->get() as $user )
    <tr>
        <td>            
            {{ Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user] , 'class'=>'form-inline']) }}                      
                {{ Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) }}
                {{ link_to_route('user.edit' ,'Edit', [$user] , ['class' => 'btn btn-xs btn-default ']) }}
            {{ Form::close() }}            
        </td>      
        <td>{{ $user->name }}</td>  
        <td>{{ $user->email }}</td>       
        <td>
            <ul>
                @foreach ( $roles->all() as $role )
                <li>
                    {{Form::checkbox('role[]', $role->id_role , $user->roles()->find($role->id_role),['class'=>'add_role','user'=>$user->id_user ,'disabled'] )}}
                    {{ link_to_route('user.role' ,$role->role_name, ['user'=>$user , 'role'=>$role] , ['class' => 'btn btn-xs btn-default ']) }}
                </li>
                @endforeach
            </ul>
        </td>        
    </tr>
    @endforeach
</table>



@push('scripts')            
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
    <script type="text/javascript">    
    //    $(document).ready(function() {
     //       $('.table').DataTable( );
     //   });
    </script>
        
    <script>
     $(".add_role").change(function(){         
           var value = $(this).val();           
           var user = $(this).attr("user"); 
           if (this.checked) {
                // the checkbox is now checked 
                var url = "/user/role";
            } else {
                // the checkbox is now no longer checked
                var url = "/user/remove_role";
            }
    
    alert(url);    
           $.ajax({
               type: "POST",
               url: url,
               data: "role="+value+"&user"+user,        //POST variable name value
               
                success: function(msg){                   
                    if(msg =='success'){
                        alert('Success');
                    } 
                    else{
                        alert('Fail');
                    }
               }
           }); 
     }); 
    </script>

@endpush

@extends('boot.layout')
@section('content')

user edit
<?= link_to_route('user.index' ,'Manage Users') ?>
<hr>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<?=Form::open(array('route' => array('user.update', $fields->id_user) , 'method' => 'put')) ?>
<table border="1">
    <tr>
        <td>
            name
        </td>
        <td>
            existent roles
        </td>
        <td>
            aditional roles
        </td>
    </tr>
    <tr>        
        <th>   
            {{ Form::text('name' , $fields-> name )}} <br />
            {{ Form::text('email' , $fields-> email )}}
        </th>
        <td>
        <?php    
            foreach ($fields->roles as $user)
            {
                echo $user->role_name . " role<br />";                
            }
            ?>
        </td>
        <td>
            <?php
                foreach ( App\Role::all() as $role)
                {
                    echo Form::checkbox('role[]', $role->id_role ); 
                    echo $role->role_name . "<br />" ;
                }
            ?>
        </td>
    </tr>
</table>
<input type="submit" value="Save">
</form>
@endsection
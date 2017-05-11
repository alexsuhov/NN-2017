@extends('layouts.clip')
@section('content')

{!! Form::open(['route' => 'user.store' , 'method' => 'POST']) !!}

<table>
    <tr>
        <td style="vertical-align: top">
            <?= Form::label('email', 'E-mail:'); ?>            
        </td>
        <td style="vertical-align: top">            
            {{ Form::email('email', '' , ['id'=>'email']) }}
            <br />
            {{ Form::checkbox('invite' , true , true , ['id'=>'invite'])}}            
            {{ Form::label('invite', 'send email invitation') }}
        </td>
        <td style="vertical-align: top"> 
            ROLES:
            <br />
            <?php    
            foreach (App\Role::all() as $role)
            {
                echo Form::checkbox('role[]', $role->id_role ,"" , ["id"=>$role->id_role]); 
                echo Form::label($role->id_role, $role->role_name ); 
                echo "<br />";
            } 
            ?>
        </td>            
    </tr>
</table>      
    <input type="submit" id="Register" />
       
{!! Form::close() !!}
@endsection
@extends('boot.layout')
@section('content')

<?= link_to_route('role.index' ,'Manage Roles', '' , ['class' => 'btn btn-success']) ?>


{{ Form::model($fields, array('route' => array('role.update', $fields->id), 'method' => 'PUT')) }}

<table>
    <tr>
        <th>
            Role name
        </th>
        <th>
            Has Users:
        </th>
        <th>
            All Users:
        </th>
    </tr>
    <tr>
        <th>
            {{$fields-> role_name}}
        </th>
        <td>
        <?php

            foreach ($fields->users as $user)
            {
                echo "<br /> user:" . $user->name;
            }
        ?>
        </td>                
        <td>
            <?php
                foreach (App\User::all() as $user)
                {
                    echo $user->name . "<br />" ;
                }
            ?>
        </td>
    </tr>
</table>
{!! Form::close() !!}
@endsection
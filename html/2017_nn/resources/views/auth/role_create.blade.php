@extends('layouts.clip')
@section('content')

<?= link_to_route('role.index' ,'Manage Roles', '' , ['class' => 'btn btn-success']) ?>

{!! Form::open(['route' => 'role.store' , 'method' => 'POST']) !!}
<table>
    <tr>
        <th width="150px">
            <?=Form::label('role_name', 'Role Name');?>
        </th>
        <td><?=Form::text('role_name');?></td>
    </tr>
    <tr>
        <th><?=Form::label('role_name', 'Add to users:');?></th>
        <td> - </td>
    </tr>
    <tr>
        <th><?=Form::label('role_name', 'Has permissions:');?></th>
        <td> - </td>
    </tr>       
</table>
<input type="submit" id="Register" value="Save Me!" />
{!! Form::close() !!}
@endsection
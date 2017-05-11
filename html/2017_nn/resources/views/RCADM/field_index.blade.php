@extends('boot.layout')

@section('content')

<style>
th {        
    width: 30%;
}
</style>
<div class="col-lg-6">
    <?php 
    if( isset($editField) ) {
        // form to delete it        
        echo Form::open(['route' => ['field.destroy', $editField ], 'method' => 'delete']) ;
        echo Form::submit("Delete $editField->tip: $editField->descriere", ['class' => 'btn btn-danger form-control']);
        echo Form::close();
            
       echo Form::open(['route' => ['field.update', $editField ], 'method' => 'put']) ;          
     } 
    else 
    {
        echo Form::open(['route' => ['field.store'], 'method' => 'POST']) ;
        echo Form::select('tip', ['doc' => 'Document', 'produs' => 'Produs' , "tab"=>"Tab"], 'doc' ,['class'=>'btn btn-default form-control']);               
        echo "<br />";        
    }
    ?> 

    {{ Form::text("descriere" , isset($editField)?$editField->descriere:"" , ['class'=>'form-control'  , "placeholder"=>"Descriere"] ) }}
    {{ Form::text("cod" , isset($editField)?$editField->cod:"" , ['class'=>'form-control' , "placeholder"=>"Cod"] ) }}
    <input type="submit" value="Save"  class="btn btn-default">  
</div>
    <hr>
    
    <table  class="table table-condensed">
    <tr>
        <th>
            Tabs
        </th>
        <th>
            Produse
        </th>
        <th>
            Documente
        </th>
    </tr>
    
    <tr>
        <td> 
            <?php
            foreach ($rows->ofType('tab')->get() as $field)
            {                
                // relate to:
                if(isset($editField) && $editField->tip == 'produs')
                echo Form::checkbox('field[]', $field->id_field , $field->fields->find($editField) );
                    
                // link to edit
                if( !isset($editField) || $field->id_field != $editField->id_field )               
                echo link_to_route('field.edit', " $field->descriere" , [$field] ) ;
                else echo $field->descriere;
                
                echo "<br />";
            } 
            ?>                
        </td>
        <td>
            <?php
            foreach ($rows->ofType('produs')->get() as $field)
            {
                // relate to:        
                if( isset($editField) && ( $editField->tip == 'tab' or $editField->tip == 'doc') )                    
                echo Form::checkbox('field[]', $field->id_field , $field->fieldsUp->find($editField) || $field->fields->find($editField) );                
                
                // link to edit
                if( !isset($editField) || $field->id_field != $editField->id_field )
                echo link_to_route('field.edit', " [$field->cod] $field->descriere" , [$field]) ;                                    
                else echo $field->descriere;
                
                echo "<br />";                
            } 
            ?>
        </td>
        <td>
            <?php
            foreach ($rows->ofType('doc')->get() as $field)
            {
                // relate to:
                if(isset($editField) && $editField->tip == 'produs')
                echo Form::checkbox('field[]', $field->id_field , $field->fieldsUp->find($editField) );
                    
                // link to edit       
                if( !isset($editField) || $field->id_field != $editField->id_field )
                echo link_to_route('field.edit', " [$field->cod] $field->descriere" , [$field]) ;
                else echo $field->descriere ;
                
                echo "<br />";
            } 
            ?>
        </td>
    </tr>
</table>
<?=Form::close();?>

@endsection

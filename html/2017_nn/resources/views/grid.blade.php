@extends('boot.layout')

@section('content')
    @include("grid.$view") 
@endsection


@push('scripts') 

    <script type="text/javascript">  

        $(".check_all").change(function(){
            $(this).closest('table').find('input.check_one:checkbox').prop('checked', this.checked);
         }); 
         
        $(".do_all").click(function(){
            var boxes = $(this).closest('table').find('input.check_one:checkbox:checked');
            
            boxes.each(function() {
                alert( "<?=route('scan.move') ?>/"+this.value );

              
              
              var jqxhr = $.ajax( "http://192.168.1.249/app2017/public/index.php/scan/" +  this.value)
  .done(function() {
    alert( "success" );
  })
  .fail(function() {
    alert( "error" );
  })
  .always(function() {
    alert( "complete" );
  });
 
// Perform other work here ...
 
// Set another completion function for the request above
jqxhr.always(function() {
  alert( "second complete" );
});
              
              
              
              
              
              
              
              
              
            });
        }); 
    </script>
@endpush
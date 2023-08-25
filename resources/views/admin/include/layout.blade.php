<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gainwell - Incident Information System</title>
    <!-- ================== jQuery ================== -->
 
<!-- DatePicker -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  
 
    
 <!--  Site Js -->
    <script src="{{URL::asset('public/assets/js/jquery.min.js')}}"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
      <!-- TimePicker -->
       <link rel="stylesheet" href="{{URL::asset('public/assets/picker/bootstrap-clockpicker.min.css')}}"type="text/css"> 
        <link rel="stylesheet" href="{{URL::asset('public/assets/picker/jquery-clockpicker.min.css')}}"type="text/css"> 
       
  <!--  time js -->
         <script src="{{URL::asset('public/assets/picker/bootstrap-clockpicker.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/picker/jquery-clockpicker.min.js')}}"></script >
      <!--    <script src="{{URL::asset('public/assets/picker/js/highlight.min.js')}}"></script> 
          <script src="{{URL::asset('public/assets/picker/js/html5shiv.js')}}"></script> 
            <script src="{{URL::asset('public/assets/picker/js/respond.min.js')}}"></script> 
 -->
    <!-- =================== bootstrap =================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/1.13.10-bootstrap-select.min.css')}}" type="text/css">
    <script src="{{URL::asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/1.13.10-bootstrap-select.min.js')}}"></script>

    <!-- ================== font-awesome ================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/font-awesome.min.css')}}" type="text/css">
  
<!-- for search date css -->
  <link rel="stylesheet" href="{{URL::asset('public/assets/css/daterangepicker.css')}}"type="text/css"> 
  
<style type="text/css">
textarea {
  display:block;
  margin:1em 0;
}  
</style> 


  <!-- for search date js -->
  <script src="{{URL::asset('public/assets/js/moment.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/daterangepicker.min.js')}}"></script>
    <!-- =================== animation =================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/animations.min.css')}}" type="text/css">
    <script src="{{URL::asset('public/assets/js/animations.min.js')}}"></script>
    <!-- ================== Back To Top ================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/bk_ttop.css')}}" type="text/css">
    <script src="{{URL::asset('public/assets/js/move-top.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/easing.js')}}"></script>
    <!-- ==================== google font ==================== -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	 <!-- ==================== picturezoom fancybox ==================== -->
	  <link rel="stylesheet" href="{{URL::asset('public/assets/fancybox/fancybox.min.css')}}" type="text/css">
	  <script src="{{URL::asset('public/assets/fancybox/fancybox.min.js')}}"></script>
    <!-- ==================== my css ==================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/responsive.css')}}" type="text/css">
    
  
       <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/> -->
  
   <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
  <!--   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	
	

    @yield('after_styles')

</head>

@include('admin.include.header')


        @yield('body')

       

@include('admin.include.footer')


















 
@yield('after_scripts')

<script >
  @if(Session::has('notification'))
  // alert("{{ Session::get('notification.alert-type') }}");
    var type = "{{ Session::get('notification.alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('notification.message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('notification.message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('notification.message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('notification.message') }}");
            break;
    }
  
   $("html,body").animate({ scrollTop: $(document).height() }, 1000);
      
  @endif
</script>
<script type="text/javascript">
		var maxLength = 500;
		$('textarea').keyup(function() {
		  var textlen = maxLength - $(this).val().length;
		  $('#rchars').text(textlen);
		});

        $('[data-fancybox="fancybox1"]').fancybox({
            buttons: [
                "fullScreen",
                "thumbs",
                "close"
            ]

        });
    </script>
	
	<script type="text/javascript">
        $('[data-fancybox="fancybox2"]').fancybox({
            buttons: [
                "fullScreen",
                "thumbs",
                "close"
            ]

        });
    </script>
	<script type="text/javascript">
        $('[data-fancybox="fancybox3"]').fancybox({
            buttons: [
                "fullScreen",
                "thumbs",
                "close"
            ]

        });
    </script>
	<script type="text/javascript">
        $('[data-fancybox="fancybox4"]').fancybox({
            buttons: [
                "fullScreen",
                "thumbs",
                "close"
            ]

        });
    </script>
	<script type="text/javascript">
        $('[data-fancybox="fancybox5"]').fancybox({
            buttons: [
                "fullScreen",
                "thumbs",
                "close"
            ]

        });
    </script>
	<script type="text/javascript">
        $('[data-fancybox="fancybox6"]').fancybox({
            buttons: [
                "fullScreen",
                "thumbs",
                "close"
            ]

        });
    </script>
</body>

</html>


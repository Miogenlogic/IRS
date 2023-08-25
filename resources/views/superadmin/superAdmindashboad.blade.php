@extends('admin.include.super_layout')
@section('after_styles')

@endsection

@section('body')
 
        <section class="repoting-form dashboard">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <h1><span>Welcome Super Administrator!</span></h1>                   
                     <div class="tab-content">
                        <!-- ============================ Start: Personal Information Tab ============================ -->
                        <div id="incidentInfo" class="tab-pane fade active show active">	
							 <ul class="incident-information d-flex justify-content-between">							
								 @php  $Countall=App\Helpers\UserHelper::Countall(); @endphp                                            
                                <li>
                                    <div class="incidentNumberBlock"><span class="incidentNumber">{{ $Countall}}</span><a href="{{url('admin/admin-incitable')}}" class="incidentTxt">Total Incidents</a></div>
                                </li>
                                 @php $Pendingrm=App\Helpers\UserHelper::Pendingrm(); @endphp									
                                <li>
                                    <div class="incidentNumberBlock closedIncident"><span class="incidentNumber">{{ $Pendingrm}}</span><a href="{{url('admin/admin-closetable')}}" class="incidentTxt">Pending Incidents with Reporting Manager</a></div>
                                </li>
                                 @php $Pendingsh=App\Helpers\UserHelper::Pendingsh(); @endphp
                                <li>
                                    <div class="incidentNumberBlock ongoingIncident"><span class="incidentNumber">{{$Pendingsh}}</span><a href="{{url('admin/admin-opentable')}}" class="incidentTxt">Pending Incidents with Safety Head </a></div>
                                </li>
							  </ul>	
							  <ul>
                                 @php $Close=App\Helpers\UserHelper::Close(); @endphp									
                                <li>
                                    <div class="incidentNumberBlock closedIncident"><span class="incidentNumber">{{ $Close}}</span><a href="{{url('admin/admin-closetable')}}" class="incidentTxt">Closed Incidents</a></div>
                                </li>
                                 @php $Open=App\Helpers\UserHelper::Open(); @endphp
                                <li>
                                    <div class="incidentNumberBlock ongoingIncident"><span class="incidentNumber">{{$Open}}</span><a href="{{url('admin/admin-opentable')}}" class="incidentTxt">Ongoing Incidents </a></div>
                                </li>		
                            </ul>
							
                            <!-- ======= start: searc-hpanel ======= -->
                             <div class="searc-hpanel">
                                
                            </div> <br>
                           
                            <!-- ======= end: searc-hpanel ======= -->
                            <!-- ========= start table ========= -->
                            <div class="table-responsive">                                
                                
                                
                            </div>
                            <!-- ========= end table ========= -->
                        </div>
                        <!-- ============================ End: Personal Information Tab ============================ -->
                    </div>
                </div>
            </div>
        </div>
    </section>


 @endsection
 @section('after_scripts')

         <script type="text/javascript">
 

    $(document).ready(function () {
    $('.tabs li a').click(function(e) {

        $('.tabs li.active').removeClass('active');

        var $parent = $(this).parent();

        $parent.addClass('active');
        e.preventDefault();
    });
});
    </script>
  
         <script type="text/javascript">
        $(document).ready(function() {
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear'
            };

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });



$('#searchfilter').keypress(function(e) { 
    if(e.keyCode==13 && e.target.value!=""){
          var clickEvent = new MouseEvent("click", {
    "view": window,
    "bubbles": true,
    "cancelable": false
});
        var elem = document.getElementById("searchbutton");
        elem.dispatchEvent(clickEvent);
    }
    return e.keyCode != 13;
});
 $(document).ready(function() {
            $("#searchicon").hide();
                });
//search

    function searchDown(e){
        //page not loading

        // e.preventDefault();
        // e.stopPropagation();
        console.log(e);
        if(e.target.value == ""){
             $("#searchicon").hide();
            console.log('success1')
             $.ajax({

        url: '{{ url("/admin/admin-table") }}',

        type: 'GET',

        data: {'_token':'{{csrf_token()}}'},

    })

        .done(function(response) {


            $('#search_data').show();
            $('#nodata').hide();
            $('#search_data').html(response);

            console.log(response);
      })
         .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });

    }else{
        $("#searchicon").show();
     //    if(e.key == "Enter"){
     // var elem = document.getElementById("searchbutton");
     //    if (typeof elem.onclick == "function") {
     //         elem.onclick.apply(elem);
     //        }
     //    }
    }

        
    }



  function OnSearch(input,e){
    console.log(e);
     // e.preventDefault();
    console.log(input.value);
    if(input.value==""){
         $("#searchicon").hide();
     $.ajax({

        url: '{{ url("/admin/admin-table") }}',

        type: 'GET',

        data: {'_token':'{{csrf_token()}}'},

    })

        .done(function(response) {


            $('#search_data').show();
            $('#nodata').hide();
            $('#search_data').html(response);

            console.log(response);
      })
         .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });


    }else{
        var clickEvent = new MouseEvent("click", {
    "view": window,
    "bubbles": true,
    "cancelable": false
});
        var elem = document.getElementById("searchbutton");
        elem.dispatchEvent(clickEvent);
        
    }
   


    }



//           $('.search_data').show();

//               $('#search_data').html(response);



// //         //     //mctype= jQuery.parseJSON(response);

//             console.log("success");

//           })

//          .fail(function() {

//             console.log("error");

//           })

//           .always(function() {

// //         //     console.log("complete");

//         });


// console.log(input);
//     }
    // $('#searchfilter').search(function(event) {
    //     console.log('hi');

    // });
    //for to date -form date

  

//         .done(function(response) {
//           //  console.log(response);

//           // if(response.length==0){
        
//           //  //  $("#nodata").hide();
//           //  //  document.getElementById('nodata').style.display = 'none';
//           //  //  let output = '<div style="text-align: center;margin-top: 30px;">'+'<label> <strong >'+'No Data Found'+'</strong></label>'+'</div>';
//           //   $('#nodata').show();
//           //   $('#search_data').hide();
//           // }else{
//           //   $('.search_data').show();
//           //   $('#search_data').html(response);
//           // }

          
            



//             //mctype= jQuery.parseJSON(response);

//         //     console.log("success");

//         // })

//         // .fail(function() {

//         //     console.log("error");

//         // })

//         // .always(function() {

//         //     console.log("complete");

//         // });



// });


 


    $(document).ready(function() {
            $("#nodata").hide();
                });
$('#searchbutton').click(function(event) {
    var search = $('#searchfilter').val();
    //alert(model);
    console.log('hi');
     $.ajax({

        url: '{{ url("/admin/admin-search") }}',

        type: 'POST',

        data: {search:search,'_token':'{{csrf_token()}}'},

    })

        .done(function(response) {
          //  console.log(response);

          if(response.length==0){
        
           //  $("#nodata").hide();
           //  document.getElementById('nodata').style.display = 'none';
           //  let output = '<div style="text-align: center;margin-top: 30px;">'+'<label> <strong >'+'No Data Found'+'</strong></label>'+'</div>';
            $('#nodata').show();
            $('#search_data').hide();
          }else{
            $('.search_data').show();
            $('#search_data').html(response);
          }

          




            //mctype= jQuery.parseJSON(response);

            console.log("success");

        })

        .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });



});
    </script>
    <a href="#" id="toTop" class="hover-bounce"></a>
    <!-- =================== end back to top =================== -->

    <!-- ================== bootstrap tooltip ================== -->
    <script>

        function dateDown(e){
        console.log(e.target.value);
        if(e.target.value == ""){
            console.log('success');
                $.ajax({

        url: '{{ url("/admin/admin-table") }}',

        type: 'GET',

        data: {'_token':'{{csrf_token()}}'},

    })

        .done(function(response) {


            $('#search_data').show();
            $('#nodata').hide();
            $('#search_data').html(response);

            console.log(response);
      })
         .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });

           
        }
 }


        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });


    </script>

   <input type="text" class="form-control" name="datefilter" />
<script type="text/javascript">
    $(function() {
            $('input[name="searchdate"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
            }
        });

        $('input[name="searchdate"]').on('apply.daterangepicker', function(ev, picker) {

                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));


               //get data
               let startdate=picker.startDate.format('DD/MM/YYYY');
               let enddate=picker.endDate.format('DD/MM/YYYY');
                //console.log(startdate,enddate);
                // var todate= 
                $.ajax({

                  url: '{{ url("/admin/admin-todate") }}',

                 type: 'POST',

                 data: {startdate:startdate,enddate:enddate,'_token':'{{csrf_token()}}'},

                 })
                 .done(function(response) {


              if(response.length==0){
        
           //  $("#nodata").hide();
           //  document.getElementById('nodata').style.display = 'none';
           //  let output = '<div style="text-align: center;margin-top: 30px;">'+'<label> <strong >'+'No Data Found'+'</strong></label>'+'</div>';
            $('#nodata').show();
            $('#search_data').hide();
          }else{
            $('.search_data').show();
            $('#search_data').html(response);
          }

            // $('#nodata').hide();
            // $('#search_data').html(response);
            // $('#search_data').show();

            console.log(response);
      })
         .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });
                //end data


                });

        $('input[name="searchdate"]').on('cancel.daterangepicker', function(ev, picker) {
               $(this).val('');
               console.log(ev);
               //mycode
                $.ajax({

        url: '{{ url("/admin/admin-table") }}',

        type: 'GET',

        data: {'_token':'{{csrf_token()}}'},

    })

        .done(function(response) {


            $('#search_data').show();
            $('#nodata').hide();
            $('#search_data').html(response);

            console.log(response);
      })
         .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });


               //endmycode
               


  });

});
</script>
    @endsection
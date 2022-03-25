@extends('layouts.mda')
@section('alladvert')
active
@endsection

@section('content')

<style>
.text-align {
    text-align: center;
    position: relative;
    margin-right: 8em;
}

.pt40 {
  padding-top: 20px;
}
  </style>


  <section class="hbox stretch">
    <section id="content">

      <section class="vbox">
        <section class="scrollable padder">
          <form action="{{action('PlanAdvertController@updateAdvert')}}" method="POST" id="updateAdvertForm">
          <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />

          <div class="m-b-md">
            <div class="col-md-8 col-md-offset-4 m-b-md m-t-md">
              <img src="{{ Auth::user()->profile_pic ? Storage::disk('s3')->url(Auth::user()->profile_pic) : url('images/download.png') }}"  class="img-responsive" height="200" width="200" alt="">
            </div>
          </div>

          <div class="row text-align">
            <h4 class="text-primary"><strong>{{strtoupper($advert->user->name)}}</strong></h4>
            <p>{{ $advert->user->address }}</p>
            <h4 class="text-success"><strong>{{strtoupper($advert->name)}}</strong></h4>
          </div>

          <div class="row m-l-md">
            <div class="col-sm-6">
              <span>
                <h4 class="m-t-md"><i class="i i-stack"></i> INTRODUCTION</h4>
              </span>
              <small class="" style="margin-left: 22px">  {{$advert->introduction}}</small>
              <span>
                <h4 class="m-t-md"><i class="i i-stack"></i> LOT DESCRIPTION</h4>
              </span>
              <?php $i = 1; ?>
              @if(sizeof($advert->advertLots))
                @foreach($advert->advertLots as $lot)
                <p style="margin-left: 22px"><strong>LOT {{$i++}}: </strong>{{$lot->description}}</p>
                @endforeach
              @else
                <span style="margin-left: 22px"><strong>NO AVAILABLE LOT </strong></span>
              @endif
              <span>
                <h4  class="m-t-md"><i class="i i-stack"></i> TENDER REQUIREMENTS</h4>
              </span>
                @if(sizeof($advert->advertCriterias ) > 0)
                  <ol>
                    @foreach($advert->advertCriterias as $requirement)
                    <li>{{$requirement->title}}</li>
                    @endforeach
                  </ol>
                @else
                  <p style="margin-left: 22px"><strong>NO RECORD FOUND </strong></p>
                @endif

              @if($advert->status != 'active')
              <div class="col-md-6">
                  <button class="btn btn-primary" disabled="disabled" id="submitBtn">Save &amp; Continue</button>
              </div>
              @endif
            </div>
            <div class="col-sm-6">
              <span>
                <h4 class="m-t-md"><i class="glyphicon glyphicon-hand-right"></i> COLLECTION OF TENDER DOCUMENTS</h4>
              </span>
              <textarea style="width: 100%; background-color: transparent; border: 0px; margin-left: 22px" id="tender_collection" name="tender_collection" placeholder="Click here to edit this default text" type="text">{{$advert->tender_collection}}</textarea>
              <span>

                <h4 class="m-t-md"><i class="glyphicon glyphicon-hand-right"></i> SUBMISSION OF TENDER DOCUMENTS</h4>
              </span>
               <p> <textarea style="width: 100%; background-color: transparent; border: 0px; margin-left: 22px" id="tender_submission" name="tender_submission" placeholder="Click here to edit this default text" type="text">{{$advert->tender_submission}}</textarea></p>
              <h4 class="m-t-md"><i class="glyphicon glyphicon-hand-right"></i> OPENING OF TENDER DOCUMENTS</h4>
               <p><textarea style="width: 100%; background-color: transparent; border: 0px; margin-left: 22px" id="tender_opening" name="tender_opening" placeholder="Click here to edit this default text" type="text">{{$advert->tender_opening}}</textarea></p>
              <input type="hidden" name="id" value="{{$advert->id}}">
              <!-- <span>
                <h4  class="m-t-md"><i class="fa fa-address-book"></i> OPENING OF TENDER DOCUMENTS</h4>
              </span>
              <input style="width: 100%; background-color: transparent; border: 0px" placeholder="Click here to edit this default text" type="text">          -->
            </div>
            </form>

          </section>
        </section>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
    </section>
  </section>

@endsection

<script>
  // window.addEventListener('load', function () {
  //   $("#updateAdvertForm").submit(function(evt){
  //   //  evt.preventDefault();
  //   //  evt.stopImmediatePropagation();
  //     $.ajaxSetup({
  //       headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       }
  //     });
  //     var url = '{{URL::to('/')}}';
  //     var dataType =  'JSON';
  //       $.ajax({
  //       type : 'POST',
  //       url : url + '/advert/update/',
  //       data :$('#updateAdvertForm').serialize(),
  //       dataType: dataType,
  //       success:function(response){
  //         console.log('success', response)

  //         $('#submitBtn').html('Submitted');
  //         $('#submitBtn').removeAttr('disabled');
  //         setTimeout(function(){
  //             $('#submitBtn').html('Save Data');
  //         },1000);
  //         toastr.success(response.success, {timeOut: 1000});

  //       },
  //       beforeSend: function(){
  //         $('#submitBtn').html('Sending..');
  //         $('#submitBtn').attr('disabled', 'disabled');
  //       },
  //       error: function(data) {
  //         console.log('error', data)
  //         $('#submitBtn').html('Try Again');
  //         $('#submitBtn').removeAttr('disabled');
  //         toastr.error(data.responseJSON.error); //{timeOut: 5000}


  //       // show error to end user
  //       }
  //     });
  //   })
  // })


   window.addEventListener('load', function () {
    $('#tender_collection, #tender_submission, #tender_opening').bind('keyup', function() {
      (allFilled()) ? $('#submitBtn').removeAttr('disabled') : $('#submitBtn').attr('disabled', 'disabled');
    });

    function allFilled() {
        var filled = true;
        $('body textarea').each(function() {
            if($(this).val() == '') filled = false;
        });
        return filled;
    }
   });


 </script>



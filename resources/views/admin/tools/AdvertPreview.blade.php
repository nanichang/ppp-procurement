@extends(getUserRole() == 'mda' ? 'layouts.mda' : 'layouts.admin')

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
          <div class=" text-left-xs text-right pt40 ">
              <a href="{{ route('viewSubmittedLots', ['advert_id' => $advert->id])}}" class="btn btn-success btn-sm"><strong>VIEW SUBMITTED LOTS</strong></a>
          </div>
            <div class="m-b-md">
              <div class="col-md-8 col-md-offset-4 m-b-md m-t-md">
                <img src="{{ $advert->user->profile_pic ? Storage::disk('s3')->url($advert->user->profile_pic) : url('images/download.png') }}"  class="img-responsive" height="200" width="200" alt="{{strtoupper($advert->user->name)}}">
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
                <p style="margin-left: 22px"> <strong>NO AVAILABLE LOT </strong></p>
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

              </div>
              <div class="col-sm-6">
                <span>
                  <h4 class="m-t-md"><i class="glyphicon glyphicon-hand-right"></i> COLLECTION OF TENDER DOCUMENTS</h4>
                </span>
                @if(!empty($advert->tender_collection))
                  <p style="margin-left: 22px">{{$advert->tender_collection}}</p>
                @else
                  <span style="margin-left: 22px">
                    <strong>NO RECORD FOUND</strong>
                  </span>
                @endif
                <span>

                  <h4 class="m-t-md"><i class="glyphicon glyphicon-hand-right"></i> SUBMISSION OF TENDER DOCUMENTS</h4>
                </span>
                @if(!empty($advert->tender_submission))
                <p style="margin-left: 22px">{{$advert->tender_submission}}</p>
                @else
                  <p><strong style="margin-left: 22px">NO RECORD FOUND</strong></p>
                @endif
                <h4 class="m-t-md"><i class="glyphicon glyphicon-hand-right"></i> OPENING OF TENDER DOCUMENTS</h4>
                @if(!empty($advert->tender_opening))
                  <p style="margin-left: 22px">{{$advert->tender_opening}}</p>
                @else
                  <p style="margin-left: 22px"><strong>NO RECORD FOUND</strong></p>
                @endif
                <h4 class="m-t-md"><i class="glyphicon glyphicon-hand-right"></i> NOTE</h4>

                <p style="margin-left: 22px">1. No Late submission</p>

              </div>


            </section>
          </section>
        </form>
      <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
    </section>
  </section>

  <script>

  window.addEventListener('load', function () {

    let data = document.getElementById('status').value;
     // console.log({data})

     if(data == 'active') {
        return $('#decline').removeAttr('disabled');
      }
      else if (data == 'disabled'){
        return $('#approve').removeAttr('disabled');
      }
      else {
        $('#decline').removeAttr('disabled');
        $('#approve').removeAttr('disabled');
      }

   });



  </script>

@endsection

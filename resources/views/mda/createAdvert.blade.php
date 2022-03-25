@extends('layouts.mda')
@section('alladvert')
active
@endsection
@section('content')
  <section class="hbox stretch">
    <section class="vbox">
      <section class="scrollable padder">
        <br/>
      <section class="panel panel-info">
        <header class="panel-heading">
          Adverts
        </header>
        <form class="bs-example form-horizontal" id="deleteAdverts" action="javascript:void(0)" Method="POST">
          <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />

          <div class="row wrapper">
            <div class="col-sm-9 m-b-xs">
              <a href="#addNewMDA" id="addNewMDA" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Create New</a>
              <button type="submit" disabled id="advertsBtn" onclick="deleteAdvert()" class="btn btn-sm btn-danger">Delete</button>
            </div>
              <div class="col-sm-3">
                <div class="input-group">
                  <input type="text" class="input-sm form-control" placeholder="Search">
                  <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button">Go!</button>
                  </span>
                </div>
              </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped b-t b-light">
              <thead>
                <tr>
                  <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input disabled="disabled" type="checkbox" ><i></i></label></th>
                  <th data-toggle="class">Budget Year</th>
                  <th>Project Title</th>
                  <th>Advert Type</th>
                  <th>Lots</th>
                  <th>Published Date</th>
                  <th>Closing Date</th>
                  <th width="200">#</th>
                </tr>
              </thead>
              <tbody id="adverts">
                @if(sizeof($adverts) > 0)
                  @foreach($adverts as $advert)

                    <tr>
                      <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="aids[]" value="{{$advert->id}}"><i></i></label></td>
                      <td>{{$advert->budget_year}}</td>
                      <td>{{$advert->name}}</td>
                      <td>{{$advert->advert_type}}</td>
                      <td id="lots">{{$advert->lots}}</td>
                      <td>{{$advert->advert_publish_date}}</td>
                      <td>{{$advert->closing_date}}</td>
                      <td>
                        <a href="#" data-id="{{ $advert->id }}" data-name="{{ $advert->name}}" class="btn btn-sm btn-primary addNewLot"><i class="fa fa-file"></i></a>
                        <!-- <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a> -->
                        <a href="{{action('MDAController@getMDAAdvertById', $advert->id)}}"  class="btn btnLink btn-sm btn-success"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('bidRequirements', $advert->id) }}" id="req" class="btn btnLink btn-sm btn-danger"><i class="fa fa-gear"></i></a>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="8"> NO RECORD FOUND </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
        </form>

      </section>

      <div class="modal fade" id="addNewMDA">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Advert Details</h4>
            </div>
            <div class="modal-body">
              <form class="bs-example form-horizontal" id="advertForm" action="javascript:void(0)" Method="POST">
                <div class="alert alert-success d-none" id="advert_div">
                  <span id="advert_message"></span>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Project Title</label>
                  <div class="col-lg-9">
                    <input name="name"  required class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Budget Year</label>
                  <div class="col-lg-9">
                    <input type="number" required name="budget_year" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Advert Type</label>
                  <div class="col-lg-9">
                  {!! Form::select('advert_type', $vehicleMakes, 'default', array('id' => 'advert_type_id', 'required' => true, 'class' => 'form-control')) !!}

                    <!-- <select name="advert_type" required class="form-control">
                      <option value="national competitive bidding">National Competitive Bidding</option>
                    </select> -->
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Advert Mode</label>
                  <div class="col-lg-9">
                  {!! Form::select('advert_mode', $vehicleModels, 'default', array('id' => 'advertMode', 'required' => true, 'class' => 'form-control')) !!}

                    <!-- <select name="advert_mode" required class="form-control">
                      <option value="invitation to tender">Invitation to Tender</option>
                    </select> -->
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Introduction</label>
                  <div class="col-lg-9">
                    <textarea name="introduction" required class="form-control"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Bid Opening Date</label>
                  <div class="col-lg-9">
                    <div id="datetimepicker1" class="input-append">
                        <input type="text" required name="bid_opening_date" class="form-control"></input>
                        <span class="add-on">
                          <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                          </i>
                        </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Bid Closing Date</label>
                  <div class="col-lg-9">
                    <div id="datetimepicker2" class="input-append">
                        <input type="text" required name="closing_date" class="form-control"></input>
                        <span class="add-on">
                          <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                          </i>
                        </span>
                    </div>
                    <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit"  id ="submitAdvert" name="submitAdvert" onclick="formAdvert()"  class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade newLotModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" >Add New Lot <small id="headerTitle"> </small></h4>
            </div>
            <div class="modal-body">
              <form class="bs-example form-horizontal" id="lotForm" action="javascript:void(0)" Method="POST" enctype="multipart/form-data">
                <input type="hidden" name="advert_id" id="advert_id" required class="form-control">

                <div class="alert alert-success d-none" id="lot_div">
                  <span id="lot_message"></span>
                </div>

                <div class="form-group">
                  <div class="col-sm-10 hidden">
                    <!-- <label class="checkbox-inline i-checks">
                      <input name="project_status" onclick="show2()" type="radio" id="inlineCheckbox1" value="approved_project"><i></i> Approved Project
                    </label> -->
                    <label class="checkbox-inline i-checks">
                      <input name="project_status" checked="true"  onclick="show1()" type="radio" id="inlineCheckbox2" value="new_project"><i></i> New Project
                    </label>
                  </div>
                </div>

                <div id="div1"   class="form-group hidden">
                  <label class="col-lg-3 control-label">Select Project</label>
                  <div class="col-lg-9">
                    <select name="project_name" class="form-control">
                      <option value="default"></option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Package No:</label>
                  <div class="col-lg-9">
                    <input name="package_no" required class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Lot No:</label>
                  <div class="col-lg-9">
                    <input name="lot_no" required class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Lot Description</label>
                  <div class="col-lg-9">
                    <textarea type="text" required name="description" class="form-control"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Lot Category</label>
                  <div class="col-lg-9">
                    <select name="lot_category" required class="form-control">
                      @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Lot Amount</label>
                  <div class="col-lg-9">
                    <input type="number" required name="lot_amount" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Upload Tender Document</label>
                  <div class="col-lg-9">
                    <input type="file" required  id="tender_document" name="tender_document" class="form-control">
                  </div>
                </div>

                <div class="modal-footer">
                  <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                  <button type="submit"  id ="saveLot" name="saveLot"  class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>

  <script type="application/javascript">
    var make_model_mapping = {!! $jsArray !!};

    window.addEventListener('load', function () {

        $('#advert_type_id').on('change', function (e) {
			    var options = $("#advertMode").empty().html(' ');
				$.each(make_model_mapping[this.value], function() {
				    options.append($("<option />").val(this.id).text(this.name));
				});
			});
    });


    function formAdvert() {
      $("#advertForm").submit(function(evt){
        evt.preventDefault();
        evt.stopImmediatePropagation();
        $cat = $('#advert_type_id').val();
        if($cat == 'default'){
            alert('Select Advert Type');
            return;
        }
        $subcat = $('#advertMode').val();
        if($subcat == 'default'){
            alert('Advert Mode is compulsory');
            return;
        }
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var url = '{{URL::to('/')}}';
        var dataType =  'JSON';
          $.ajax({
          type : 'POST',
          url : url + '/advert/create',
          data :$('#advertForm').serialize(),
          dataType: dataType,
          success:function(data){
            $('#submitAdvert').html('Submitted');
            $('#submitAdvert').removeAttr('disabled');
            $('#advert_message').show();
            $('#advert_div').show();
            $('#advert_message').html(data.success);
            $('#advert_div').removeClass('d-none');
            document.getElementById("advertForm").reset();
            toastr.success(data.success, {timeOut: 1000});

            setTimeout(function(){
                $('#advert_message').hide();
                $('#advert_div').hide();
                $('#submitAdvert').html('Save Data');
                $('.close').trigger('click');
            },1000);

            loadAdverts('/advert/adverts', function(data){
            });

          },
          beforeSend: function(){
            $('#submitAdvert').html('Sending..');
            $('#submitAdvert').attr('disabled', 'disabled');
          },
          error: function(data) {
            console.log('error', data)
            $('#submitAdvert').html('Try Again');
            $('#submitAdvert').removeAttr('disabled');
            toastr.error('Error!', data.responseJSON.error);
          // show error to end user
          }
        });
      })
    }

    function loadAdverts(adverts, cb) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      var url = '{{URL::to('/')}}';
      var dataType =  'JSON';
      $.ajax({
        type : 'GET',
        url : url + adverts,
        success:function(data){
          data = data.adverts;
          $('#adverts').empty();
          $.each(data, function (i) {
            $('#adverts').append(
                '<tr>'+
                  '<td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="aids[]" value="'+data[i].id+'"><i></i></label></td>' +
                  '<td>'+data[i].budget_year+'</td>' +
                  '<td>'+data[i].name+'</td>' +
                  '<td>'+data[i].advert_type+'</td>'+
                  '<td>'+data[i].lots+'</td>'+
                  '<td>'+data[i].advert_publish_date+'</td>'+
                  '<td>'+data[i].bid_opening_date+'</td>'+
                  '<td>'+
                  '<a href="#" data-id="'+data[i].id+'" data-name="'+data[i].name+'" class="btn btn-sm btn-primary addNewLot"><i class="fa fa-file"></i></a>'+
                  '<a href="#" class="btn btnLink btn-sm btn-warning"><i class="fa fa-edit"></i></a>'+
                  // '<a href="#" class="btn btnLink btn-sm btn-success"><i class="fa fa-eye"></i></a>'+
                  '<a href="/mda/advert/bidrequirement/'+data[i].id+'/" class="btn btnLink btn-sm btn-danger"><i class="fa fa-gear"></i></a>'+
                  '</td>'+
                '</tr>'
              );
              location.reload();

            });
          },
        });
      }

      function deleteAdvert(){
        $("#deleteAdverts").submit(function(evt){
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = '{{URL::to('/')}}';
            var dataType =  'JSON';

            $.ajax({
                type : 'POST',
                url : url + '/advert/delete',
                data :$('#deleteAdverts').serialize(),
                dataType: dataType,
                success:function(data){
                  $('#advertsBtn').html('Delete');
                  $('#advertsBtn').removeAttr('disabled');
                  loadAdverts('/advert/adverts', function(data){
                  });

                },
                beforeSend: function(){
                  $('#advertsBtn').html('Sending..');
                  $('#advertsBtn').attr('disabled', 'disabled');
                },
                error: function(data) {
                    $('#advertsBtn').html('Try Again');
                    $('#advertsBtn').removeAttr('disabled');
                 }
            });
        })

      }

    function show1() {
      document.getElementById('div1').style.display = 'none';
    }

    function show2() {
      document.getElementById('div1').style.display = 'block';
    }

    window.addEventListener('load', function () {
      $(".addNewLot").on('click', function(evt){
        evt.preventDefault();
        var currentId = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('#headerTitle').html(' '+name);
        $('#advert_id').val(currentId);

        if(!currentId){
          console.log("Bug");
          return;
        }

        $(".newLotModal").modal('show');
      });
    });

    window.addEventListener('load', function () {
      $("#lotForm").submit(function(evt){
        evt.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var url = '{{URL::to('/')}}';
        var dataType =  'JSON';
        $.ajax({
          type : 'POST',
          url : url + '/advert-lot/create',
          data: new FormData( this ),
          contentType: false,
          processData: false,
        // data :$('#lotForm').serialize(),
        // data : new FormData($("#lotForm")[0]),
          dataType: dataType,

          success:function(data){
            $('#saveLot').html('Submitted');
            $('#saveLot').removeAttr('disabled');
            $('#lot_message').show();
            $('#lot_div').show();
            $('#lot_message').html(data.success);
            $('#lot_div').removeClass('d-none');
            document.getElementById("lotForm").reset();
            setTimeout(function(){
                $('#lot_message').hide();
                $('#lot_div').hide();
                $('#saveLot').html('Save Data');
                $('.close').trigger('click');
            },1000);

            loadAdverts('/advert/adverts', function(data){
            });

          },
          beforeSend: function(){
            $('#saveLot').html('Sending..');
            $('#saveLot').attr('disabled', 'disabled');
          },
          error: function(data) {
            console.log('error', data)
            $('#saveLot').html('Try Again');
            $('#saveLot').removeAttr('disabled');

          // show error to end user
          }
        });
      });
    });

    window.addEventListener('load', function () {
      $(document).ready(function() {
        var sumchecked = 0;
        $('#adverts').on('change', 'input[type="checkbox"]', function(){
          ($(this).is(':checked')) ? sumchecked++ : sumchecked--;
          (sumchecked > 0) ? $('#advertsBtn').removeAttr('disabled') : $('#advertsBtn').attr('disabled', 'disabled');

        });
      });
    });

  window.addEventListener('load', function () {
    // $(document).ready(function() {
      $(function() {
        $('#datetimepicker1').datetimepicker({
            format : 'YYYY-MM-DD HH:mm'
        });
        $('#datetimepicker2').datetimepicker({
          format : 'YYYY-MM-DD HH:mm'
        });
      });
  //  });
  });
  </script>
@endsection




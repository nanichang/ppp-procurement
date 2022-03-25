@extends('layouts.mda')
@section('alladvert')
active
@endsection

@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <br/>
            <section class="panel panel-default">
                <header class="panel-heading">
                    Tender Requirement/Eligibility Criteria
                </header>
                <form class="bs-example form-horizontal" action="{{route('storeRequirement')}}" Method="POST">
                  <input type="hidden" value="{{$advert->id}}" name="advertId"/>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th></th>
                                <th width="100">Required</th>
                            </tr>
                        </thead>
                        <tbody id="names">
                            @if(sizeof($names) > 0)
                                @foreach($names as $name)
                                <tr>
                                    <td>{{$name->certificate_name}}</td>
                                    <td>
                                        <?php
                                        $found = false;
                                        foreach($advert->tenderRequirement as $item){
                                            if($item->tender_eligibility_id == $name->id) $found = true;
                                        }
                                        ?>
                                        <label class="checkbox m-l m-t-none m-b-none i-checks">
                                        <input {{ $found ? "checked" : ""}} type="checkbox" value="{{$name->id}}" name="requirement[]"><i></i></label>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">
                                        No Record Found
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="row" style="padding-left: 10px; padding-right: 10px;">
                    <div class="col-md-6">
                        <a href="{{ route('newMdaAdvert') }}" class="btn btn-default">Back to Lots</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" name="updateBtn" id="updateBtn" class="btn btn-primary">Update</button>
                        <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />

                    </div>
                </div>
                </form>
                <br/>
            </section>
        </section>
    </section>
</section>

<script>

    // window.addEventListener('load', function () {
    //   $(document).ready(function() {
    //     var sumchecked = 0;
    //     $('#names').on('change', 'input[type="checkbox"]', function(){
    //       ($(this).is(':checked')) ? sumchecked++ : sumchecked--;
    //       (sumchecked > 0) ? $('#updateBtn').removeAttr('disabled') : $('#updateBtn').attr('disabled', 'disabled');

    //     });
    //   });
    // });

</script>
@endsection

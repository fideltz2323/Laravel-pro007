@extends('layouts.app')

@section('content')
<?php
use Carbon\Carbon;
?>
    <section class="content-header">
      <h1> {{ Lang::get('core.packages') }}</h1>
    </section>

  <div class="content">

<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			<a href="{{ url($pageModule.'?return='.$return) }}" class="tips"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left fa-2x"></i></a>
		</div>
	</div>
    @if( $row['start']> Carbon::today() or $row['start'] ==NULL )
	<div class="box-body">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>


		 {!! Form::open(array('url'=>'packages/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

  		{!! Form::hidden('packageID', $row['packageID']) !!}
              <div class="form-group  " >
                  <label for="Tour Category" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tourcategory') }} <span class="asterix"> * </span></label>
  									<div class="col-md-4">
  									  <select name='tourcategoriesID' rows='5' id='tourcategoriesID' class='select2 ' required  ></select>
  									 </div>
  								  </div>
									  <div class="form-group  " >
										<label for="Tour Name" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tourname') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <select name='tourID' rows='5' id='tourID' class='select2 ' required  ></select>
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Tour Code" class=" control-label col-md-4 text-left"> {{ Lang::get('core.tourcode') }} <span class="asterix"> * </span></label>
										<div class="col-md-4">
										  <input  type='text' name='tour_code' id='tour_code' value='{{ $row['tour_code'] }}'
						required     class='form-control ' />
										 </div>
									  </div>
									  <div class="form-group  " >
										<label for="Start Date" class="control-label col-md-4 text-left"> {{ Lang::get('core.start') }} <span class="asterix"> * </span></label>
										<div class="col-md-7">
                				<div class="input-group" style="width:150px !important;" id="dpd1">
                					{!! Form::text('start', $row['start'],array('class'=>'form-control date', 'autocomplete'=>'off')) !!}
                					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                				</div>
										 </div>
									  </div>
									  <div class="form-group">
										  <label for="End Date" class=" control-label col-md-4 text-left"> {{ Lang::get('core.end') }} <span class="asterix"> * </span></label>
  										<div class="col-md-7">
                				<div class="input-group" style="width:150px !important;" id="dpd2">
                					{!! Form::text('end', $row['end'],array('class'=>'form-control date', 'autocomplete'=>'off')) !!}
                					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                				</div>
  										</div>
									  </div>
                    <div class="form-group  " >
                    <label for="Cost" class=" control-label col-md-4 text-left"> {{ Lang::get('core.cost') }} <span class="asterix"> * </span></label>
                    <div class="col-md-2">
                      <input  type='text' name='cost' id='cost' value='{{ $row['cost'] }}' required class='form-control ' />
                     </div>
                     <div class="col-md-5">
                         <div class="form-group  " >
                          <label for="Currency" class=" control-label col-md-4 text-left"> {{ Lang::get('core.currency') }} <span class="asterix"> * </span></label>
                          <div class="col-md-3">
                            <select name='currencyID' rows='5' id='currencyID' class='select2 ' required  ></select>
                          </div>
                        </div>
                     </div>
                    </div>
                  <div class="form-group  " >
                    <label for="Tour Category" class=" control-label col-md-4 text-left"> {{ Lang::get('core.flight') }} <span class="asterix"> * </span></label>
                      <div class="col-md-4">
                          <select name="flight" multiple="" rows="5" id="flight"
                                  class="select2 parsley-validated" required=""
                                  tabindex="-1" aria-hidden="true">
                              <option value="">-- Please Select --</option>
                              @php
                                  $ticketIds = json_decode($row['flight']);
                              @endphp
                              @foreach($tickets as $ticket)
                                  <option {{ $ticketIds?(in_array($ticket->ticketID,$ticketIds)?'selected':''):''}} value="{{$ticket->ticketID}}">
                                    {{$loop->index+1}}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-md-2">
                        <button type="button" name="button" class="btn btn-success" id="tickets_modal_btn" data-toggle="modal" data-target="#tickets_modal">{{ Lang::get('core.choose') }}</button>
                      </div>
                  </div>
                  <div class="form-group" >
									<label for="Group Size" class=" control-label col-md-4 text-left"> {{ Lang::get('core.groupsize') }} <span class="asterix"> * </span></label>
  									 <div class="col-md-2">
  									    <input  type='text' name='groupsize' id='groupsize' value='{{ $row['groupsize'] }}' required class='form-control ' />
  									 </div>
                     <div class="col-md-3">
                        <label for="Group Size" class=" control-label col-md-4 text-left"> {{ Lang::get('core.parts') }}</label>
  										  <input  type='text' name='parts' id='parts' value='{{ $row['parts'] }}' required class='form-control ' />
  									 </div>
								  </div>
                <div class="form-group  " >
										<label for="Featured" class=" control-label col-md-4 text-left"> {{ Lang::get('core.featured') }} </label>
										<div class="col-md-7">
										  <?php $featured = explode(",",$row['featured']); ?>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='featured' value ='1'   class=''
					@if(in_array('1',$featured))checked @endif
					 />  </label>
										 </div>
									  </div>
									  <div class="form-group">
										<label for="Definite Departure" class=" control-label col-md-4 text-left"> {{ Lang::get('core.definitedeparture') }} </label>
										<div class="col-md-7">
										  <?php $definite_departure = explode(",",$row['definite_departure']); ?>
					 <label class='checked checkbox-inline'>
					<input type='checkbox' name='definite_departure' value ='2'   class=''
					@if(in_array('2',$definite_departure))checked @endif
					 /> </label>
										 </div>
									  </div>
          <div class="row" id="part_lists">
            @for($index = 0; $index < 5; $index++)
          <fieldset id="part_{{$index}}" style="display:none;"><legend>{{ Lang::get('core.part') }}_{{$index+1}}</legend>
            <input type="text" name="tour_feature_id" value="" style="display:none;">
            <div class="form-group  " >
  						<label for="Country" class=" control-label col-md-4 text-left"> {{ Lang::get('core.country') }} </label>
  						<div class="col-md-4">
  						  <select name='countryID[]' rows='5' id='countryID_{{$index}}' class='select2 country'></select>
						  </div>
					  </div>
        <div class="form-group  " >
						<label for="City" class="control-label col-md-4 text-left"> {{ Lang::get('core.city') }} </label>
						<div class="col-md-4">
						  <select name='cityID[]' rows='5' id='cityID_{{$index}}' class='select2 city'   ></select>
						 </div>
					  </div>
            <div class="form-group  " >
            <label for="Start Date" class=" control-label col-md-4 text-left"> {{ Lang::get('core.start') }} <span class="asterix"> * </span></label>
            <div class="col-md-7">
                <div class="input-group m-b" style="width:150px !important;" id="dpd1">
                  {!! Form::text('part_start[]', $row['start'],array('class'=>'form-control date', 'autocomplete'=>'off')) !!}
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
             </div>
            </div>
            <div class="form-group  " >
            <label for="End Date" class=" control-label col-md-4 text-left"> {{ Lang::get('core.end') }} <span class="asterix"> * </span></label>
            <div class="col-md-7">
              <div class="input-group m-b" style="width:150px !important;" id="dpd2">
                {!! Form::text('part_end[]', $row['end'],array('class'=>'form-control date', 'autocomplete'=>'off')) !!}
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
             </div>
            </div>
					  <div class="form-group  " >
						<label for="Transfer" class=" control-label col-md-4 text-left"> {{ Lang::get('core.vehicletypes') }} </label>
						<div class="col-md-2">
              <select name='vehicleID[]' rows='5' id='vehicleID_{{$index}}' class='select2 vehicle'></select>
						 </div>
					  </div>
					  <div class="form-group  " >
						<label for="Hotel " class=" control-label col-md-4 text-left"> {{ Lang::get('core.hotel') }}  </label>
						<div class="col-md-2">
              <select name='hotelID[]' rows='5' id='hotelID_{{$index}}' class='select2 hotelID'></select>
						 </div>
					  </div>
          </fieldset>
          @endfor
        </div>
          <div class="form-group  " >
						<label for="Remarks" class=" control-label col-md-4 text-left"> {{ Lang::get('core.remarks') }}</label>
						<div class="col-md-6">
						  <textarea name='remarks' rows='5' id='remarks' class='form-control' required>{{ $row['remarks'] }}</textarea>
						 </div>
					  </div>
            <div class="form-group  " >
							<label for="Status" class=" control-label col-md-4 text-left"> {{ Lang::get('core.status') }} <span class="asterix"> * </span></label>
							<div class="col-md-7">

    					<label class='radio radio-inline'>
    					<input type='radio' name='status' value ='0' required @if($row['status'] == '0') checked="checked" @endif > {{ Lang::get('core.fr_minactive') }} </label>
    					<label class='radio radio-inline'>
    					<input type='radio' name='status' value ='1' required @if($row['status'] == '1') checked="checked" @endif > {{ Lang::get('core.fr_mactive') }} </label>
    					<label class='radio radio-inline'>
    					<input type='radio' name='status' value ='2' required @if($row['status'] == '2') checked="checked" @endif > {{ Lang::get('core.cancelled') }} </label>
						 </div>
					  </div>
			<div style="clear:both"></div>

				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">
					<button type="submit" name="apply" class="btn btn-info btn-sm" > {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" > {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('packages?return='.$return) }}' " class="btn btn-danger btn-sm ">  {{ Lang::get('core.sb_cancel') }} </button>
					</div>

				  </div>

		 {!! Form::close() !!}
	</div>
    @else

    <H1>{{ Lang::get('core.youcanteditthistour') }}</H1>

    @endif

</div>
<div class="modal fade in" id="tickets_modal"  role="dialog" style=" padding-right: 16px;">
    <div class="modal-dialog" style="width:1200px;">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <button type="button " class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">{{__('core.choose')}}</h4>
            </div>
            <div class="modal-body" id="edit-modal-content">
              <div class="table-responsive" style="min-height:300px; min-width:600px; padding-bottom:60px; border: none !important">
                @if(count($rowData)>=1)
                  <table class="table table-striped " id="ticketsTable">
                      <thead>
                      <tr>
                      <th width="10"> No </th>
                      <th width="30"></th>
                      <th>{{Lang::get('core.airlines')}}</th>
                      <th>{{Lang::get('core.from')}}</th>
                      <th>{{Lang::get('core.to')}}</th>
                      <th>{{Lang::get('core.departuredate')}}</th>
                      <th>{{Lang::get('core.flightNO')}}</th>
                      <th>{{Lang::get('core.returndate')}}</th>
                      <th>{{Lang::get('core.flightNO')}}</th>
                      <th>{{Lang::get('core.seats')}}</th>
                      <th>{{Lang::get('core.seatsavailable')}}</th>
                      <th>{{Lang::get('core.class')}}</th>
                      <th width="30">{{Lang::get('core.status')}}</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $i = 0; foreach ($rowData as $row) :
                          $id = $row->ticketID;
                      ?>
                        <tr class="editable" id="form-{{ $row->ticketID }}">
                        <td class="number"> <?php echo ++$i;?>  </td>
                        <td ><input type="checkbox" class="ids" name="ids[]" value="<?php echo $row->ticketID ;?>" />  </td>
                       <td data-values="{{ $row->airlinesID }}" data-field="airlinesID">
                         @foreach($airlines as $a)
                             <?php
                             $airlineIds = json_decode($row->airlinesID);
                             foreach ($airlineIds as $airlineId) {
                               if($airlineId == $a->airlineID)
                                 echo "<span>".$a->airline??''."</span>";
                              }
                             ?>
                         @endforeach
                       </td>
                       <td data-values="{{ $row->depairportID }}" data-field="depairportID">
                           @foreach($airports as $a)
                               <?php
                                 if($row->depairportID == $a->airportID){
                                   echo "<span>".$a->airport_name??''."</span>";
                                 }
                               ?>
                           @endforeach
                        </td>
                        <td data-values="{{ $row->arrairportID }}" data-field="arrairportID">
                            @foreach($airports as $a)
                                <?php
                                  if($row->arrairportID == $a->airportID){
                                    echo "<span>".$a->airport_name??''."</span>";
                                  }
                                ?>
                            @endforeach
                         </td>
                         <td data-values="{{ $row->departing }}" data-field="departing">
                            <span>{{$row->departing}}</span>
                         </td>
                         <td data-values="{{ $row->arrFlightNO }}" data-field="arrFlightNO">
                            <span>{{$row->arrFlightNO}}</span>
                         </td>
                         <td data-values="{{ $row->returning }}" data-field="returning">
                            <span>{{$row->returning}}</span>
                         </td>
                         <td data-values="{{ $row->depFlightNO }}" data-field="depFlightNO">
                            <span>{{$row->depFlightNO}}</span>
                         </td>
                         <td data-values="{{ $row->seats }}" data-field="seats">
                            <span>{{$row->seats}}</span>
                         </td>
                         <td data-values="{{ $row->available_seats }}" data-field="available_seats">
                            <span>{{$row->available_seats}}</span>
                         </td>
                         <td data-values="{{ $row->class }}" data-field="class">
                           @if($row->class == '1')
                               {{ __('core.economy')}}
                           @elseif($row->class == '2')
                               {{ __('core.premiumeconomy')}}
                           @elseif($row->class == '3')
                               {{ __('core.business') }}
                           @elseif($row->class == '4')
                               {{ __('core.first')}}
                           @endif
                         </td>
                         <td data-values="{{ $row->status }}" data-field="status">
                           @if($row->status == '2')
                               <span class="label label-warning">{{ __('core.fr_pending') }}</span>
                           @elseif($row->status == '1')
                               <span class="label label-success">{{ __('core.confirmed') }}</span>
                           @elseif($row->status == '0')
                               <span class="label label-danger">{{ __('core.cancelled') }}</span>
                           @endif
                         </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                  </table>
                @else

                <div style="margin:100px 0; text-align:center;">
                  <p> {{ Lang::get('core.norecord') }} </p>
                </div>

                @endif
                <div class="form-group">
                    <label class="col-sm-5 text-right">&nbsp;</label>
                    <div class="col-sm-7">
                        <button type="button" id="storeBtn" class="btn btn-success btn-sm"> Save </button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"> Cancel </button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
</div>
   <script type="text/javascript">
	$(document).ready(function() {
    $("#flight").select2({ width:"100%" , dropdownParent: $('#mmb-modal-content')});
		$("#tourcategoriesID").jCombo("{!! url('packages/comboselect?filter=def_tour_categories:tourcategoriesID:tourcategoryname&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["tourcategoriesID"] }}' });
    $("#currencyID").jCombo("{!! url('extraexpenses/comboselect?filter=def_currency:currencyID:currency_sym|symbol&limit=WHERE:status:=:1') !!}",
		{  selected_value : '{{ $row["currencyID"] }}' });
		$("#tourID").jCombo("{!! url('packages/comboselect?filter=tours:tourID:tour_name&limit=WHERE:departs:=:3') !!}&parent=tourcategoriesID:",
		{  parent: '#tourcategoriesID', selected_value : '{{ $row["tourID"] }}' });
    for(var i =0; i< 5; i++){
      $("#countryID_"+i).jCombo("{!! url('packages/comboselect?filter=def_country:countryID:country_name') !!}");
      $("#cityID_"+i).jCombo("{!! url('packages/comboselect?filter=def_city:cityID:city_name') !!}&parent=countryID:",
      {  parent: '#countryID_'+i });
      $("#vehicleID_"+i).jCombo("{!! url('packages/comboselect?filter=def_vehicle:vehicleID:vehicle_name') !!}");
      $("#hotelID_"+i).jCombo("{!! url('packages/comboselect?filter=hotels:hotelID:hotel_name') !!}");
    }

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("packages/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();
			return false;
		});
	});
  $("#parts").change(function (){
    if($(this).val()>5){
      $(this).val(5);
    }
    var count = $(this).val()
    for( var i = 0; i < count; i++){
      $("#part_"+i).show();
    }
    for( var i = count; i< 5; i++){
      $("#part_"+i).hide();
    }
  });
  $(".date").datetimepicker({
      format: 'yyyy-mm-dd',
      startDate: '{{ Carbon::today()->format('Y-m-d') }}',
      autoclose:true ,
      minView:2 ,
      startView:2 ,
      todayBtn:true
  });
  $('#ticketsTable').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": false,
    "autoWidth": false
  });
  $("#storeBtn").click(function(){
    var ids = [];
    $('.ids').each(function(i, obj) {
      if(obj.checked)
        ids.push(obj.value);
    });
    $("#flight").val(ids);
    $("#flight").select2({ width:"100%" , dropdownParent: $('#mmb-modal-content')});
    $("#tickets_modal").modal('hide');
  });
  $("input[name='groupsize'], input[name='cost_single[]'], input[name='cost_double[]'], input[name='cost_triple[]'], input[name='cost_child[]'], input[name='parts']").TouchSpin();
</script>


@stop

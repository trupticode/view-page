@extends("layouts.header")
@section('content')

<ul class="breadcrumb">
            <li><a href="{{ url('/home')}}">Home</a></li>
            <li><a href="{{ url('/listworkmasters')}}">Workmaster</a></li>
            <li><a href="{{ url('billlist', $work_id ?? '') }}">Bill</a></li>
            <!-- <li><a href="{{ url('RouteCheckListAB', $t_bill_id ?? '') }}">Check List AB</a></li> -->
        </ul>



        <form  action="{{ url('SaveChklstAB') }}" method="post">
@csrf
    <input type="hidden" name="t_bill_id" value="{{$t_bill_id}}">
    <input type="hidden" name="work_id" value="{{$work_id}}">


<div class="container">
    <h4 style="margin-top:100px;">CheckList Of Auditor</h4>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-success">
        <tr>
            <th style="width: 0.2%;">SR.NO</th>
          <th style="width: 45%;">Name</th>
          <th style="width: 40%;">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>1</td>
          <td>Name of Work</td>
          <input type="hidden" name="work_nm" value="{{$workNM}}">
          <td >{{$workNM}}</td>
        </tr>
        <tr>
            <td>2</td>
          <td>Fund Head</td>
          <input type="hidden" name="F_H_Code" value="{{$FH_code}}">
          <td>{{$FH_code}} </td>
        </tr>
        <tr>
<td>3</td>

        <td>Whether arithmatic check is done ?</td>
        <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Arith_chk" value="Yes"  {{ $Arith_chk === 'Yes' ? 'checked' : '' }} > Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Arith_chk" value="No" {{ $Arith_chk === 'No' ? 'checked' : '' }} > No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Arith_chk" value="Not Required" {{ $Arith_chk === 'Not Required' ? 'checked' : '' }} > Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Arith_chk" value="Not Applicable" {{ $Arith_chk === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
    </label>
</td>
        </tr>

        <tr>
    <td>4</td>

        <td> Whether Work Insurance Policy & Premium Paid Receipt submitted by Contractor ?</td>
        <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Ins_Policy_Agency" value="Yes"  {{ $Ins_Policy_Agency === 'Yes' ? 'checked' : '' }} > Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Ins_Policy_Agency" value="No" {{ $Ins_Policy_Agency === 'No' ? 'checked' : '' }} > No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Ins_Policy_Agency" value="Not Required" {{ $Ins_Policy_Agency === 'Not Required' ? 'checked' : '' }} > Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Ins_Policy_Agency" value="Not Applicable" {{ $Ins_Policy_Agency === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
    </label>
</td>
        </tr>


        <tr>
        <td>5</td>

          <td> If Yes, amount of premium paid</td>
          <td>
          <input type="text" class="form-control" id="Ins_Prem_Amt_Agency" name="Ins_Prem_Amt_Agency" value="{{$Ins_Prem_Amt_Agency}}"> 
        </td>

        </tr>


        <tr>
<td>6</td>

        <td>  Does necessary Deductions and Recoveries are considered while preparing bill ?</td>
        <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Bl_Rec_Ded" value="Yes"  {{ $Bl_Rec_Ded === 'Yes' ? 'checked' : '' }} > Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Bl_Rec_Ded" value="No" {{ $Bl_Rec_Ded === 'No' ? 'checked' : '' }} > No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Bl_Rec_Ded" value="Not Required" {{ $Bl_Rec_Ded === 'Not Required' ? 'checked' : '' }} > Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Bl_Rec_Ded" value="Not Applicable" {{ $Bl_Rec_Ded === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
    </label>
</td>
        </tr>


        <tr>
        <td>7</td>

          <td> Gross Bill Amount</td>
          <td>
          <input type="text" class="form-control" name="C_netAmt" id="C_netAmt"value="{{$C_netAmt}}">
        </td>
        </tr>

        <tr>
        <td>8</td>

          <td>  Total Deductions</td>
          <td>
          <input type="text" class="form-control" name="tot_ded" value="{{$tot_ded}}">
            </td>
        </tr>



        <tr>
            <td>9</td>
            <td>  Cheque Amount</td>
            <td>
            <input type="text" class="form-control" name="chq_amt" value="{{$chq_amt}}">
            </td>
        </tr>
        
        
        
        <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Auditor Checked </label>
        @if($Aud_chck === 1)
            <input  class="checkbox col-md-1" type="checkbox" name="ABcheckbox" required checked >
            @else
            <input  class="checkbox col-md-1" type="checkbox" name="ABcheckbox" required >
            @endif
    </td>
    <td>
    <div class="row">
        <div class="col-md-7">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -80px;" class="form-control" type="date" name="ABdate"
             required value="{{$Aud_Chk_Dt}}" min="{{$lastPOdate}}" max="{{$stupulatedDate}}">
        </div>
    </div>
</td>
</tr> -->


@if(auth()->user()->usertypes === "AAO") 
        <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Divisional Accountant Checked</label>
        <input style="" class="form-check-input col-md-3" type="checkbox" name="AAOcheckbox" required checked>
        <input style="" class="form-check-input col-md-3" type="checkbox" name="AAOcheckbox" required >

    </td>
    <td colspan="3">
    <div class="row">
        <div class="col-md-7">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input  class="form-control" style="margin-left: -200px;" type="date" name="AAOdate" >
        </div>
    </div>
    </td>
</tr> -->

        @endif




        
        </tbody>
    </table>
  </div>
</div>

<!-- <div class="row" style="margin-left: 80px;">
    <div class="col-md-2 col-xl-2 col-lg-3">
            <label style="font-weight: bold;">Auditor Checked </label>
            @if($Aud_chck === 1)
            <input  class="checkbox col-md-1" type="checkbox" name="ABcheckbox" required checked >
            @else
            <input  class="checkbox col-md-1" type="checkbox" name="ABcheckbox" required >
            @endif
        </div>

        <div class="col-md-3 col-xl-2 col-lg-4">
            <input class="form-control"  type="hidden" style="margin-left: -80px;" name="lastPOchkDate" value="{{$lastPOdate}} ">
            <input style="margin-left: -80px;" class="form-control" type="date" name="ABdate"
             required value="{{$Aud_Chk_Dt}}" min="{{$lastPOdate}}" max="{{$stupulatedDate}}">
        </div>
  </div> -->



<!-- @if(auth()->user()->usertypes === "AAO") 
<div class="row" style="margin-left: 80px;">
  <div class="col-md-1 col-xl-3 col-lg-3">
<label style="font-weight: bold;">AAO Check </label>
<input style="" class="form-check-input col-md-3" type="checkbox" name="AAOcheckbox" required checked>
<input style="" class="form-check-input col-md-3" type="checkbox" name="AAOcheckbox" required >
</div>
<div class="col-md-1 col-xl-2 col-lg-6">
<input  class="form-control" style="margin-left: -200px;" type="date" name="AAOdate" >
</div>

</div>
@endif -->

<!-- <div class="col-md-3  col-xl-2">

@if($DBchklst_AudiExist !== null)
<button type="submit" name="action" value="update" class="btn btn-primary mt-5" style="margin-left:370px;">Update</button>
@else
<button type="submit" name="action" value="save" class="btn btn-primary mt-5" style="margin-left:370px;">Save</button>
@endif
</div>
 -->


 <div class="row justify-content-center">
    <div class="col-md-3 col-xl-2">
    @if($DBchklst_AudiExist !== null)
<button type="submit" name="action" value="update" class="btn btn-primary mt-5" style="">Update</button>
@else
<button type="submit" name="action" value="save" class="btn btn-primary mt-5" style="">Submit</button>
@endif
</div>
</div>


</form>









<br><br><br>
 @endsection()

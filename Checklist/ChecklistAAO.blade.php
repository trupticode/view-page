@extends("layouts.header")
@section('content')

<ul class="breadcrumb">
            <li><a href="{{ url('/home')}}">Home</a></li>
            <li><a href="{{ url('/listworkmasters')}}">Workmaster</a></li>
            <li><a href="{{ url('billlist', $work_id ?? '') }}">Bill</a></li>
            <!-- <li><a href="{{ url('RouteCheckListAAO') }}">Check List Accountant</a></li> -->
        </ul>



        <form  action="{{ url('submitAAOChkAndDate') }}" method="post">
@csrf
    <input type="hidden" name="t_bill_id" value="{{$t_bill_id}}">
    <input type="hidden" name="work_id" value="{{$work_id}}">


<div class="container">
    <h4 style="margin-top:100px;">CheckList Of Accountant</h4>
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
        <td> {{$Arith_chk}}</td>
        </tr>

        <tr>
    <td>4</td>

        <td> Whether Work Insurance Policy & Premium Paid Receipt submitted by Contractor ?</td>
        <td>{{$Ins_Policy_Agency}}</td>
        </tr>


        <tr>
        <td>5</td>

          <td> If Yes, amount of premium paid</td>
          <td>{{$Ins_Prem_Amt_Agency}}</td>

        </tr>


        <tr>
<td>6</td>

        <td>  Does necessary Deductions and Recoveries are considered while preparing bill ?</td>
        <td>{{$Bl_Rec_Ded}}</td>
        </tr>


        <tr>
        <td>7</td>

          <td> Gross Bill Amount</td>
          <td>{{$C_netAmt}}</td>
        </tr>

        <tr>
        <td>8</td>

          <td>  Total Deductions</td>
          <td> {{$tot_ded}} </td>
        </tr>



        <tr>
            <td>9</td>
            <td>  Cheque Amount</td>
            <td> {{$chq_amt}}</td>
        </tr>

        <?php
            $commonHelper = new \App\Helpers\CommonHelper();
        ?>
        <tr>
        <td>10</td>
            <td  style="text-align :Left;font-weight: bold;"> passed For Rs.</td>
            <td style="font-weight: bold;">
            <input type="text" name="AAOCnetAmt" class="form-control" value="{{$C_netAmt}}">
            ( {{ $commonHelper->convertAmountToWords($C_netAmt) }} )</td>
          </tr>

        
        
        <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Auditor Checked </label>
        @if($Aud_chck === 1)
            <input  class="checkbox col-md-2" type="checkbox" disabled name="ABcheckbox" required checked >
            @else
            <input  class="checkbox col-md-2" type="checkbox" disabled name="ABcheckbox" required >
            @endif
    </td>
    <td>
    <div class="row">
        <div class="col-md-7">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -80px;" class="form-control" type="date" readonly name="ABdate" required value="{{$Aud_Chk_Dt}}" min="{{$lastPOdate}} ">
        </div>
    </div>
</td>
</tr> -->


@if(auth()->user()->usertypes === "AAO") 
        <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Divisional Accountant Checked</label>
        @if($AAO_Chk === 1)
                    <input class="checkbox col-md-2" class="form-check-input" type="checkbox" name="AAOcheckbox" required checked>
                    @else
                    <input class="checkbox col-md-2" class="form-check-input" type="checkbox" name="AAOcheckbox" required >
           @endif
    </td>
    <td colspan="3">
    <div class="row">
        <div class="col-md-6">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -50px;" class="form-control" type="date" name="AAOdate" 
               value="{{$AAO_Chk_Dt}}" min="{{$Aud_Chk_Dt}}"  max="{{$stupulatedDate}}">
        </div>
    </div>
    </td>
</tr> -->
@endif






        </tbody>
    </table>
  </div>
</div>



<div class="row justify-content-center">
    <div class="col-md-3 col-xl-2">
    <button type="submit"  class="btn btn-primary mt-5" style="">Submit</button>
</div>
</div>


<!-- <button type="submit"  class="btn btn-primary mt-5" style="">Submit</button> -->

</form>

<br><br><br><br>
 @endsection()

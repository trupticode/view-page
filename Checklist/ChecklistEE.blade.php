@extends("layouts.header")
@section('content')

<ul class="breadcrumb">
            <li><a href="{{ url('/home')}}">Home</a></li>
            <li><a href="{{ url('/listworkmasters')}}">Workmaster</a></li>
            <li><a href="{{ url('billlist', $workid ?? '') }}">Bill</a></li>
            <!-- <li><a href="{{ url('/RouteCheckListEE') }}">Check List EE</a></li> -->

        </ul>


        <form  action="{{ url('submitEEChkAndDate') }}" method="post">
@csrf
    <input type="hidden" name="tbill_id" value="{{$t_bill_Id}}">
    <input type="hidden" name="Work_Id" value="{{$workid}}">


<div class="container">
    <h4 style="margin-top:100px;">CheckList Of Project Officer</h4>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-success">
        <tr>
            <th>SR.NO</th>
          <th>Name</th>
          <th>Description</th>
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
                    <td>Whether Check List filled by Sub Division is proper ?</td>
                        <input type="hidden" name="" value="{{$SD_chklst}}">
                    <td> {{$SD_chklst}} </td>
        </tr>
        <tr>
                <td>3</td>
                <td>Whether all Q.C. Tests required for the work have been coducted ?</td>
                <td>{{$QC_T_Done}}
                </td>
        </tr>
        <tr>
                <td>4</td>
                <td>Whether the number of tests are correct as per standards ?</td>
                <td>{{$QC_T_No}}
                </td>
        </tr>
        <tr>
                <td>5</td>
                <td>Whether Q.C. Test results are satisfactory ?</td>
                <td>{{$QC_Result}}
                </td>
        </tr>

        <tr>
                <td>6</td>
                <td>SQM Checking / Third Party Audit carried out For this Work?</td>
                <td>{{$SQM_Chk}}</td>
        </tr>     



        <tr>
                <td>7</td>
                <td>Whether Part Rate / Reduced Rate are correct & technically proper ?</td>
                <td>{{$Part_Red_Rt_Proper}}
                </td>
        </tr>
        <tr>
                <td>8</td>
                <td>Whether quantity of any item of work has been exceeded 125% of tender quantity ?</td>
                <td> {{$Excess_qty_125}}
                </td>
        </tr>

        <tr>
                <td>9</td>
                <td>If yes, proposal for effecting Clause-38 has been submitted by Sub Division with proper reasons.</td>
                <td> {{$CL_38_Prop}}
                </td>
        </tr>

        <tr>
                <td>10</td>
                <td>Whether Board showing Name of Work, Name of Agency, DLP, etc. is fixed on site of work ?</td>
                <td> {{$CFinalbillBoard}}
                </td>
        </tr>

        <!-- <tr>
                <td>10</td>
                <td>Whether record drawing is attached ?</td>
                <td> {{ $Rec_Drg}}
                </td>
        </tr> -->
        <tr>
                <td>11A</td>
                <td>Uptodate Royalty Charges payable</td>
                <td>{{$TotRoy}}
                </td>
        </tr>

        <tr>
                <td>11B</td>
                <td>Royalty Charges previously paid / recovered</td>
                <td>{{$PreTotRoy}}
                </td>
        </tr>

        <tr>
                <td>11C</td>
                <td>Royalty Charges paid by contractor for this bil</td>
                <td>{{$Cur_Bill_Roy_Paid}}
                </td>
        </tr>

        <tr>
                <td>11D</td>
                <td>Royalty Charges proposed to be recovered from this bill</td>
                <td>{{$Roy_Rec}}
                </td>
        </tr>

        <tr>
                <td>12A</td>
                <td>Tender cost of work</td>
                <input type="hidden" name="Tnd_Amt" value="{{$Tnd_Amt}}"  > 
                <td> {{$Tnd_Amt}}
                </td>
        </tr>

        <tr>
                <td>12B</td>
                <td>Uptodate Bill Amount of work</td>
                <input type="hidden" name="Net_Amt" value="{{$netAmt}}"  > 

                <td>{{$netAmt}}
                </td>
        </tr>

        <tr>
                <td>12C</td>
                <td>Current Bill Amount</td>
                <input type="hidden" name="C_NetAmt" value="{{$c_netamt}}"  > 

                <td>{{$c_netamt}}
                </td>
        </tr>

        <tr>
                <td>13</td>
                <td>Actual Date of Completion </td>
                <input type="hidden" name="Act_Comp_Dt" value="{{$Act_Comp_Dt}}"  > 
                <td>{{ date('d/m/Y', strtotime($Act_Comp_Dt)) }}</td>
        </tr>

        <tr>
                <td>14</td>
                <td>M.B. No & Date of Recording </td>
                <input type="hidden" name="MB_NO" value="{{$MBNO}}"  >
                <input type="hidden" name="MB_DT" value="{{$DBMB_Dt}}"  > 
                <td> {{$MBNO}}   &nbsp; &nbsp;  Date:  {{ $DBMB_Dt ? date('d/m/Y', strtotime($DBMB_Dt)) : '' }}
                </td>
        </tr>

        <!-- <tr>
                <td>15</td>
                <td>Whether Mode of Measurement are correct ?</td>
                <td>{{$Mess_Mode}}
                </td>
        </tr>
 
         <tr>
                <td>16</td>
                <td>Whether consumptions of material are correct ?</td>
                <td>{{ $Mat_cons}}
                </td>
        </tr> -->

        <tr>
                <td>15</td>
                <td>Work Completion Certificate (Form-65) attached ?</td>
                <td> {{ $CFinalbillForm65}}
                </td>
        </tr>

        <tr>
                <td>16</td>
                <td>Letter / Certificate regarding handover of work attached ?</td>
                <td> {{ $CFinalbillhandover}}
                </td>
        </tr>

        <tr>
                <td>17</td>
                <td>Reduced Estimate Prepaired And Submitted For this Work?</td>
                <td> {{ $Red_Est}}</td>
        </tr>




        <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Project officer Checked</label>
        @if($PO_Chk === 1)
            <input  class="checkbox col-md-2" type="checkbox" disabled name="POcheckbox" required checked value="{{$PO_Chk}}">
            @else
            <input  class="checkbox col-md-2" type="checkbox" disabled name="POcheckbox" required value="{{$PO_Chk}}" >
            @endif
    </td>
    <td>
    <div class="row">
        <div class="col-md-7">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -100px;"  class="form-control" type="date" readonly name="POdate" required value="{{$PO_Chk_Dt}}" min="{{$lstDYEcheckdate}}">
        </div>
    </div>
</td>
</tr> -->



@if(auth()->user()->usertypes === "EE") 
        <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Executive Engineer Checked</label>
        @if($EE_Chk === 1)
            <input  class="checkbox col-md-2" type="checkbox" name="EEcheckbox" required checked>
            @else
            <input  class="checkbox col-md-2" type="checkbox" name="EEcheckbox" required >
            @endif
    </td>
    <td colspan="3">
    <div class="row">
        <div class="col-md-7">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -100px;" class="form-control" type="date" name="EEdate" required 
        value="{{$EE_Chk_Dt}}" min="{{$PO_Chk_Dt}}" max="{{$stupulatedDate}}">
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
            <label style="font-weight: bold;">PO Check </label>
            @if($PO_Chk === 1)
            <input  class="checkbox col-md-2" type="checkbox" disabled name="POcheckbox" required checked value="{{$PO_Chk}}">
            @else
            <input  class="checkbox col-md-2" type="checkbox" disabled name="POcheckbox" required value="{{$PO_Chk}}" >
            @endif
      </div>
      <div class="col-md-3 col-xl-2 col-lg-4">
      <input class="form-control"  type="hidden" name="lastDyechkDate" value="{{$lstDYEcheckdate}}">
        <input style="margin-left: -100px;"  class="form-control" type="date" readonly name="POdate" required value="{{$PO_Chk_Dt}}" min="{{$lstDYEcheckdate}}">
    </div>
  </div> -->


  <!-- @if(auth()->user()->usertypes === "PA") 
  <div class="row" style="margin-top: 10px;">
        <div class="col-md-5">
            <label style="margin-left: 380px;  font-weight: bold;">PA Check </label>
            @if($workid === 1)
            <input  class="checkbox col-md-2" type="checkbox" name="DYEcheckbox" required checked>
            @else
            <input  class="checkbox col-md-2" type="checkbox" name="DYEcheckbox" required >
            @endif
      </div>
      <div class="col-md-2">
      <input class="form-control"  type="hidden" name="lastPOchkDate" value="{{$PO_Chk_Dt}}">
        <input class="form-control" type="date" name="PAdate" required value="" min="{{$PO_Chk_Dt}}">
    </div>
  </div>
  @endif -->

  <!-- @if(auth()->user()->usertypes === "EE") 
  <div class="row" style="margin-left: 80px;">
    <div class="col-md-2 col-xl-2 col-lg-3">
            <label style="font-weight: bold;">EE Check </label>
            @if($EE_Chk === 1)
            <input  class="checkbox col-md-2" type="checkbox" name="EEcheckbox" required checked>
            @else
            <input  class="checkbox col-md-2" type="checkbox" name="EEcheckbox" required >
            @endif
      </div>
      <div class="col-md-3 col-xl-2 col-lg-4">
      <input class="form-control"  type="hidden" name="lastPOchkDate" value="{{$PO_Chk_Dt}}">
        <input style="margin-left: -100px;" class="form-control" type="date" name="EEdate" required 
        value="{{$EE_Chk_Dt}}" min="{{$PO_Chk_Dt}}" max="{{$stupulatedDate}}">
    </div>
  </div>
  @endif -->
  <!-- ////////////Acoountant Details///////////////////// -->
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
            <td  > passed For Rs.</td>
            <td >{{$C_netAmt}} &nbsp; &nbsp;( {{ $commonHelper->convertAmountToWords($C_netAmt) }} )</td>
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
        <div class="col-md-6">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -60px;" class="form-control" type="date" readonly name="ABdate" required value="{{$Aud_Chk_Dt}}" min="{{$lastPOdate}} ">
        </div>
    </div>
</td>
</tr> -->

<!-- <tr>
    <td colspan="2">
    <label style="font-weight: bold;">Accountant Check </label>
                    @if($AAO_Chk === 1)
                    <input class="checkbox col-md-2" disabled class="form-check-input" type="checkbox" name="AAOcheckbox" required checked>
                    @else
                    <input class="checkbox col-md-2" disabled class="form-check-input" type="checkbox" name="AAOcheckbox" required >
                    @endif
    </td>
    <td>
    <div class="row">
        <div class="col-md-6">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -60px;" class="form-control mt-2" readonly type="date" name="AAOdate"
         value="{{$AAO_Chk_Dt}}" min="{{$Aud_Chk_Dt}}" >
        </div>
    </div>
</td>
</tr> -->


@if(auth()->user()->usertypes === "EE") 
        <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Executive Engineer Checked</label>
        @if($AAOEE_Chk === 1)
            <input   class="checkbox col-md-2" type="checkbox" name="EEcheckboxAuditor" required checked>
            @else
            <input   class="checkbox col-md-2" type="checkbox" name="EEcheckboxAuditor" required >
            @endif
    </td>
    <td colspan="3">
    <div class="row">
        <div class="col-md-7">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -100px;" class="form-control" type="date" name="EEdateAuditor" 
        required value="{{$AAOEE_Chk_Dt}}" min="{{$AAO_Chk_Dt}}" max="{{$stupulatedDate}}">
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
            <label style="font-weight: bold;">Auditor Check </label>
            @if($Aud_chck === 1)
            <input  class="checkbox col-md-2" type="checkbox" disabled name="ABcheckbox" required checked >
            @else
            <input  class="checkbox col-md-2" type="checkbox" disabled name="ABcheckbox" required >
            @endif
        </div> 

        <div class="col-md-3 col-xl-2 col-lg-4">
            <input class="form-control"  type="hidden" name="lastPOchkDate" value="{{$lastPOdate}} ">
            <input style="margin-left: -60px;" class="form-control" type="date" readonly name="ABdate" required value="{{$Aud_Chk_Dt}}" min="{{$lastPOdate}} ">
        </div>
  </div>
 -->


  <!-- <div class="row" style="margin-left: 80px;">
    <div class="col-md-2 col-xl-2 col-lg-3">
                    <label style="font-weight: bold;">Accountant Check </label>
                    @if($AAO_Chk === 1)
                    <input class="checkbox col-md-2" disabled class="form-check-input" type="checkbox" name="AAOcheckbox" required checked>
                    @else
                    <input class="checkbox col-md-2" disabled class="form-check-input" type="checkbox" name="AAOcheckbox" required >
                    @endif
            </div>
            <div class="col-md-3 col-xl-2 col-lg-4">
                <input class="form-control"  type="hidden" name="lastABchkDate" value="{{$Aud_Chk_Dt}} ">
        <input style="margin-left: -40px;" class="form-control mt-2" readonly type="date" name="AAOdate"
         value="{{$AAO_Chk_Dt}}" min="{{$Aud_Chk_Dt}}" >
                </div>
    </div> -->


    <!-- @if(auth()->user()->usertypes === "EE") 
    <div class="row" style="margin-left: 80px;">
    <div class="col-md-2 col-xl-2 col-lg-3">
            <label style="font-weight: bold;">EE Check </label>
            @if($AAOEE_Chk === 1)
            <input   class="checkbox col-md-2" type="checkbox" name="EEcheckboxAuditor" required checked>
            @else
            <input   class="checkbox col-md-2" type="checkbox" name="EEcheckboxAuditor" required >
            @endif
      </div>
      <div class="col-md-3 col-xl-2 col-lg-4">
      <input class="form-control"  type="hidden" name="lastAAOchkDate" value="{{$AAO_Chk_Dt}}">
        <input style="margin-left: -100px;" class="form-control" type="date" name="EEdateAuditor" 
        required value="{{$AAOEE_Chk_Dt}}" min="{{$AAO_Chk_Dt}}" max="{{$stupulatedDate}}">
    </div>
  </div>
  @endif -->


  <div class="row justify-content-center">
    <div class="col-md-3 col-xl-2">
    <button type="submit"  class="btn btn-primary mt-5" style="">Submit</button>
</div>
</div>



</form>
<br><br><br>
@endsection
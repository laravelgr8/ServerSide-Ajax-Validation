<td>
  <input type="text" class="form-control" name="claimed_amount[]" value="@if($line->{'Bill Claim Amount'} > 0){{round($line->{'Bill Claim Amount'},4)  ?? ''}} @endif" onkeypress="return isNumber(event)" maxlength="10">
    <span id="msg_{{$key}}" style="color: red;"></span>
</td>


$validator = Validator::make($request->all(), [
    'Order_id'          => 'required',
    'Account_rep'       => 'required',
    'billOfficerName'   => 'required',
    'billOfficerDesign' => 'required',
    'email'             => 'required',
    'from_date'         => 'required',
    'to_date'           => 'required',
    "claimed_amount"    => "required",
    "claimed_amount.*"  => "required"
]);
if ($validator->fails()) {
    $response = json_encode($validator->errors()->all());
    return response()->json(['error'=>$response]);
}



----------
$(document).ready(function() {
    $(".btn-submit").click(function(e){
        e.preventDefault();
        var data =new FormData($("#AVradioMediaBillingFrm")[0]);
        $.ajax({
            url: "/savebilling",
            type:'POST',
            data: data,
            contentType:false,
            cache:false,
            processData:false,
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    swal("Success","Data has been saved successfully","success").then(function () {
                      window.location = 'radio-billing';
                    });
                }else{
                    printErrorMsg(data.error);
                }
            }
        });
   
    }); 
   
    function printErrorMsg (msg) {
        
        var obj = JSON.parse(msg);
        $.each(obj, function (key, val) {
          var split_obj = val.split('.');
          var get_id = split_obj[1].split('field');
          $("#msg_"+get_id[0]).html("This field "+get_id[1]);
      });
        
    }
});
<!DOCTYPE html>
<html>
<head>
    <title>Ajax Validation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
</head>
<body>
       
<div class="container">
    <h2>Ajax Validation</h2>
       
    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
       
    <form>
        {{ csrf_field() }}
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" class="form-control" placeholder="First Name">
            <span id="fname" style="color: red;"></span>
        </div>
       
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
            <span id="lname" style="color: red;"></span>
        </div>
       
        <div class="form-group">
            <strong>Email:</strong>
            <input type="text" name="email" class="form-control" placeholder="Email">
            <span id="email" style="color: red;"></span>
        </div>
       
        <div class="form-group">
            <strong>Address:</strong>
            <textarea class="form-control" name="address" placeholder="Address"></textarea>
            <span id="address" style="color: red;"></span>
        </div>
       
        <div class="form-group">
            <button class="btn btn-success btn-submit">Submit</button>
        </div>
    </form>
</div>
       
<script type="text/javascript">
       
    $(document).ready(function() {
        $(".btn-submit").click(function(e){
            e.preventDefault();
       
            var _token = $("input[name='_token']").val();
            var first_name = $("input[name='first_name']").val();
            var last_name = $("input[name='last_name']").val();
            var email = $("input[name='email']").val();
            var address = $("textarea[name='address']").val();
       
            $.ajax({
                url: "{{ route('my.form') }}",
                type:'POST',
                data: {_token:_token, first_name:first_name, last_name:last_name, email:email, address:address},
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        alert(data.success);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
       
        }); 
       
        function printErrorMsg (msg) {
            console.log(msg[1]);
            $("#fname").html(msg[0]);
            $("#lname").html(msg[1]);
            $("#email").html(msg[2]);
            $("#address").html(msg[1]);
            // $(".print-error-msg").find("ul").html('');
            // $(".print-error-msg").css('display','block');
            // $.each( msg, function( key, value ) {
            //     $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            // });
        }
    });


</script>


</body>
</html>
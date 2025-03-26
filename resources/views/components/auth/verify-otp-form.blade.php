<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>ENTER OTP CODE</h4>
                    <br/>
                    <label>4 Digit Code Here</label>
                    <input id="otp" placeholder="Code" class="form-control" type="text"/>
                    <br/>
                    <button onclick="VerifyOtp()"  class="btn w-100 float-end bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    VerifyOtp()
    async function VerifyOtp(){
        let otp = document.getElementById('otp').value;
        //when i send otp this time i set the email value in the session storage. now i get this value
        let emailVal = sessionStorage.getItem('email');
        if(otp.length > 4){
            try{
                showLoader();
                let res = await axios.post('/verifyOTP',{
                    otp: otp,
                    email : emailVal
                });
                console.log(res);
                hideLoader();
                if(res.status === 200 && res.data["status"] === "success"){
                    successToast(res.data["message"]);
                    setTimeout(function (){
                        window.location.href = '/resetpassword';
                    },1000);
                }else{
                    errorToast(res.data["message"]);
                }
            }catch (error){
                console.log(error);
            }
        }else{
        }
    }
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>EMAIL ADDRESS</h4>
                    <br/>
                    <label>Your email address</label>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <button onclick="VerifyEmail()"  class="btn w-100 float-end bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    VerifyEmail();
    async function VerifyEmail(){
        let email = document.getElementById("email").value;
        if(email.length === 0){
            errorToast("Fill-Up Email")
        }
        else{
            try {
                showLoader();
                let res = await axios.post('/sendOtpCode',{
                    email: email
                });
                hideLoader();
                if(res.data["status"] === "success" && res.status === 200){
                    sessionStorage.setItem('email', email);
                    successToast(res.data["message"]);
                    setTimeout(function (){
                        window.location.href = '/verifyOTP';
                    });
                }
                else{
                    errorToast(res.data["message"]);
                }
            }catch (error){
                console.log(error);
            }
        }
    }

</script>

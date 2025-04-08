<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>
        </div>
    </div>
</div>

<script>


    //for fatch category in the database and set it inside the form


    async function getCategory(){
        try {
            document.getElementById('categoryNameUpdate').value = null;
            let updateID = document.getElementById('updateID').value;
            let res = await axios.get('/ShowCategoryUpdateFormData',{
                params :{id : updateID}
            });
            let data = res.data['value'];
            document.getElementById('categoryNameUpdate').value = data['name'];
        }catch (e){
            console.log(e);
        }

    }


    async function Update(){
        let categoryNameUpdate = document.getElementById('categoryNameUpdate').value;
        let categoryId = document.getElementById('updateID').value;
        showLoader();
        let res = await axios.post('/categoryUpdate',{
            name : categoryNameUpdate,
            id : categoryId
        });


        hideLoader();
        console.log(res);


        if(res.status === 200){
            console.log("Come here");
            successToast(res.data['message']);
            document.getElementById("update-form").reset();
            document.getElementById('update-modal-close').click();

            // Refresh the table data without reloading the page
            await getList();
        }else{
            errorToast(res.data['message']);
        }
    }
</script>

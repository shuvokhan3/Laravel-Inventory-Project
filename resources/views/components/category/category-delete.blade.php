<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Are You Sure, You Want To Delete This Category?</p>
                <input class="d-none" id="deleteID"/>
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn bg-gradient-success mx-2" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete" class="btn bg-gradient-danger" >Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    async function itemDelete(){
        //catch id
        let idDelete = document.getElementById('deleteID').value;
        // //close the model
        document.getElementById('delete-modal-close').click()
        //
        showLoader();
        let res = await axios.post('/categoryDelete',{
            id : idDelete
        });
        hideLoader();
        if(res.data === 1 ){
            successToast("Category Delete Successfully!!");
            await getList();
        }else{
            errorToast("Failed");
        }
    }
</script>

<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Create Category</h6>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryName">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn bg-gradient-success" >Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function Save() {
        let categoryName = document.getElementById('categoryName').value;

        if(!categoryName) {
            errorToast("Category name is required!");
            return;
        }

        try {
            showLoader();
            let res = await axios.post('/createCategory', {
                'name': categoryName
            }, {
                headers: {
                    // Make sure these headers are being sent if your controller requires them
                    'id': localStorage.getItem('user_id'), // Assuming you store user ID in localStorage
                    'email': localStorage.getItem('user_email') // Assuming you store user email in localStorage
                }
            });
            hideLoader();

            if (res.status === 201 || res.status === 200) { // Accept both 200 and 201
                successToast(res.data.message);
                document.getElementById("save-form").reset();
                document.getElementById('modal-close').click();

                // Refresh the table data without reloading the page
                await getList();
            }
        } catch (error) {
            hideLoader();
            errorToast(error.response?.data?.message || "Something went wrong!");
        }
    }
</script>

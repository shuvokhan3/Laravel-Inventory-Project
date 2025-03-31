<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Category</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-secondary"/>
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="tableList">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    async function getList() {
        try {
            showLoader();
            let res = await axios.get('/categoryList');
            hideLoader();

            let tableData = $("#tableData");
            let tableList = $("#tableList");

            // Destroy existing DataTable instance
            if ($.fn.DataTable.isDataTable('#tableData')) {
                tableData.DataTable().destroy();
            }

            // Clear the table body
            tableList.empty();

            // Check if we have data
            if (res.data && (Array.isArray(res.data) || typeof res.data === 'object')) {
                // Convert to array if it's an object
                let data = Array.isArray(res.data) ? res.data : [res.data];

                // Populate the table
                data.forEach(function (item, index) {
                    let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item.name}</td>
                    <td>
                        <button data-id="${item.id}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item.id}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>`;
                    tableList.append(row);
                });
            }

            // Initialize DataTable with options
            new DataTable('#tableData');
        } catch (error) {
            hideLoader();
            errorToast("Failed to load categories");
            console.error(error);
        }
    }
    // Initial load
    $(document).ready(function() {
        //when i add a new category this time call getList(),
        //// Refresh the table data without reloading the page
        getList();

        // Add event listeners for edit and delete buttons
        $(document).on('click', '.editBtn', function() {
            let id = $(this).data('id');
            $("#update-modal").modal('show');
            $("#updateID").val(id);

            // Call getCategory() only after setting the ID
            getCategory();

        });

        $(document).on('click', '.deleteBtn', function() {
            let id = $(this).data('id');
            //this line for show delete popup or modal, it's mean another blade component
            $("#delete-modal").modal('show')
            $("#deleteID").val(id);
        });
    });
</script>

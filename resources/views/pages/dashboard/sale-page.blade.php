@extends('layout.sidenav-layout')
@section('content')
    <div class="container-fluid">
        <div class="row">

            <!-- Invoice Section -->
            <div class="col-md-4 col-lg-4 p-3">
                <div class="shadow h-100 bg-white rounded-lg p-4 border">
                    <!-- Header Section -->
                    <div class="row mb-3 align-items-center">
                        <div class="col-8">
                            <h5 class="font-weight-bold text-dark mb-3">INVOICE</h5>
                            <div class="client-info">
                                <p class="text-sm mb-1"><strong>Billed To:</strong></p>
                                <p class="text-sm mb-1"><span id="CName" class="text-muted"></span></p>
                                <p class="text-sm mb-1"><span id="CEmail" class="text-muted"></span></p>
                                <p class="text-sm mb-1"><small class="text-muted">Client ID: <span id="CId"></span></small></p>
                            </div>
                        </div>
                        <div class="col-4 text-right">
                            <img class="img-fluid mb-2" src="{{'images/logo.png'}}" alt="Company Logo">
                            <p class="text-sm mb-1"><strong>Date:</strong> {{ date('Y-m-d') }}</p>
                            <p class="text-sm mb-1"><strong>Invoice #:</strong> INV-{{rand(10000,99999)}}</p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="my-3 border-top border-gray-200">

                    <!-- Items Table -->
                    <div class="row mb-3 color-background color-green">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-borderless" id="invoiceTable">
                                    <thead>

                                    </thead>
                                    <tbody id="invoiceList">
                                    <!-- Example item row for visual reference -->

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <!-- Summary Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-secondary">Subtotal:</span>
                                    <span class="text-secondary">$ <span id="total"></span></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-secondary">VAT (2%):</span>
                                    <span class="text-secondary">$ <span id="vat"></span></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-secondary">Discount:</span>
                                    <span class="text-secondary">$ <span id="discount">0</span></span>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between font-weight-bold">
                                    <span class="text-primary">TOTAL DUE:</span>
                                    <span class="text-primary">$ <span id="payable"></span></span>
                                </div>
                            </div>

                            <!-- Discount Controls -->
                            <div class="mt-4">
                                <div class="form-group">
                                    <label for="discountP" class="text-secondary font-weight-medium">Discount (%)</label>
                                    <div class="input-group">
                                        <input onkeydown="return false" value="0" min="0" type="number" step="0.25"
                                               onchange="DiscountChange()" class="form-control text-center" id="discountP"/>

                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button onclick="CreateInvoice()" class="btn btn-block mt-4 py-2 text-white font-weight-medium" style="background-color: #D1299B;">
                                <i class="bi bi-check-circle me-1"></i> CONFIRM INVOICE
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Product Section-->
            <div class="col-md-4 col-lg-4 p-3">
                <div class="shadow h-100 bg-white rounded-lg p-4 border">
                    <table class="table  w-100" id="productTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Product</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="productList">

                        </tbody>
                    </table>
                </div>
            </div>

            <!--Customer Section -->
            <div class="col-md-4 col-lg-4 p-3">
                <div class="shadow h-100 bg-white rounded-lg p-4 border">
                    <table class="table table-sm w-100" id="customerTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Customer</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="customerList">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>




    <div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
                </div>
                <div class="modal-body">
                    <form id="add-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label" >Product ID *</label>
                                    <input type="text" class="form-control" id="PId">
                                    <label class="form-label mt-2">Product Name *</label>
                                    <input type="text" class="form-control" id="PName">
                                    <label class="form-label mt-2">Product Price *</label>
                                    <input type="text" class="form-control" id="PPrice">
                                    <label class="form-label mt-2">Product Qty *</label>
                                    <input type="text" class="form-control" id="PQty">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="add()" id="save-btn" class="btn bg-gradient-success" >Add</button>
                </div>
            </div>
        </div>
    </div>

    <script>



        (async ()=>{
            showLoader();
            await  CustomerList();
            await ProductList();
            hideLoader();
        })()


        let InvoiceItemList = [];
        async function CustomerList(){
            let res = await axios.get('/customerList')
            let customerList = $("#customerList");
            let customerTable = $("#customerTable");
            customerTable.DataTable().destroy();
            customerList.empty();
            res.data.forEach(function (item,index) {
                let row=`<tr class="text-xs">
                        <td><i class="bi bi-person"></i> ${item['name']}</td>
                        <td><a data-name="${item['name']}" data-email="${item['email']}" data-id="${item['id']}" class="btn btn-outline-dark addCustomer  text-xxs px-2 py-1  btn-sm m-0">Add</a></td>
                     </tr>`
                customerList.append(row)
            });
            $('.addCustomer').on('click', async function (){
                let CName = $(this).data('name');
                let CEmail = $(this).data('email');
                let CId = $(this).data('id');

                $("#CName").text(CName);
                $("#CEmail").text(CEmail);
                $("#CId").text(CId);
            })
            new DataTable('#customerTable',{
                order:[[0,'desc']],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });
        }

        function addModal(name, price, id) {
            document.getElementById('PId').value = id;
            document.getElementById('PName').value = name;
            document.getElementById('PPrice').value = price;
            $('#create-modal').modal('show')
        }

        async function ProductList(){

            let res = await axios.get('/productList');

            let productTable = $("#productTable");
            let productList = $("#productList");

            productTable.DataTable().destroy();
            productList.empty();

            res.data.forEach(function (item,index) {
                let row=`<tr class="text-xs">
                        <td> <img class="w-10" src="${item['img_url']}"/> ${item['name']} ($ ${item['price']})</td>
                        <td><a data-name="${item['name']}" data-price="${item['price']}" data-id="${item['id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProduct  btn-sm m-0">Add</a></td>
                     </tr>`
                productList.append(row)
            })

            $('.addProduct').on('click', async function(){
               let PName = $(this).data('name');
               let PPrice = $(this).data('price');
               let PId = $(this).data('id');
                addModal(PName, PPrice, PId);
            });


            new DataTable('#productTable',{
                order:[[0,'desc']],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });


        }

        async function add(){
           let PId = document.getElementById('PId').value;
           let PName = document.getElementById('PName').value;
           let PPrice = document.getElementById('PPrice').value;
           let PQty = document.getElementById('PQty').value;

           //String to number convertion;
            PPrice = Number(PPrice);
            PQty = Number(PQty);


           let PTotalPrice = (parseFloat(PPrice) * parseFloat(PQty)).toFixed(2);


           if(PId.length === 0){
               errorToast("ID Do Not Exits!");
           }else if(PName.length === 0){
               errorToast("Product Name Required!");
           }else if(PPrice.length === 0){
               errorToast("Product Price Required!");
           }else if(PQty.length === 0){
               errorToast("Product Quantity Required!");
           }else{

               let item = {
                   product_name:PName,
                   product_id:PId,
                   qty:PQty,
                   sale_price:PTotalPrice
               }

               InvoiceItemList.push(item);

               $('#create-modal').modal('hide')
               ShowInvoiceItem()
           }
        }

        function ShowInvoiceItem(){
            let invoiceList = $('#invoiceList');

            invoiceList.empty();

            InvoiceItemList.forEach(function (item, index){
                let row=`<tr class="text-xs">
                        <td>${item['product_name']}</td>
                        <td>${item['qty']}</td>
                        <td>${item['sale_price']}</td>
                        <td><a data-index="${index}" class="btn remove text-xxs px-2 py-1  btn-sm m-0">Remove</a></td>
                     </tr>`
                invoiceList.append(row);
            });

            CalculateTotal();

            $('.remove').on('click',function (){
                let index = $(this).data('index');
                removeItem(index);
            });
        }

        function removeItem(index){
            InvoiceItemList.splice(index,1);
            ShowInvoiceItem();
        }

        function CalculateTotal(){
            let Total=0;
            let Vat=0;
            let Payable=0;
            let Discount=0;
            let discountPercentage=(parseFloat(document.getElementById('discountP').value));

            InvoiceItemList.forEach((item,index)=>{
                Total=Total+parseFloat(item['sale_price'])
            })

            if(discountPercentage===0){
                Vat= ((Total*5)/100).toFixed(2);
            }
            else {
                Discount=((Total*discountPercentage)/100).toFixed(2);
                Total=(Total-((Total*discountPercentage)/100)).toFixed(2);
                Vat= ((Total*2)/100).toFixed(2);
            }

            Payable=(parseFloat(Total)+parseFloat(Vat)).toFixed(2);


            document.getElementById('total').innerText=Total;
            document.getElementById('payable').innerText=Payable;
            document.getElementById('vat').innerText=Vat;
            document.getElementById('discount').innerText=Discount;
        }

        function DiscountChange(){
            CalculateTotal();
        }

        async function CreateInvoice(){
            let total = document.getElementById('total').innerHTML
            let payable = document.getElementById('payable').innerHTML;
            let vat = document.getElementById('vat').innerHTML
            let discount = document.getElementById('discount').innerHTML;
            let CId = document.getElementById('CId').innerHTML;

            if(CId.length===0){
                errorToast("Customer Required!")
            }
            else if(InvoiceItemList.length===0){
                errorToast("Product Required!")
            }else{

                let Data = {
                    "total":total,
                    "discount":discount,
                    "vat":vat,
                    "payable":payable,
                    "customer_id":CId,
                    "products":InvoiceItemList
                }

                showLoader();
                let res = await axios.post('/invoiceCreate',Data);
                hideLoader();

                if(res.data === 1 && res.status === 200){
                    successToast("Invoice Created!");
                    window.location.href = '/invoicePage';
                }else{
                    errorToast("Something Went Wrong!");
                }
            }


        }



    </script>



@endsection



<div class="dashboard-container py-4 px-3">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-primary font-weight-bold mb-0">Dashboard Overview</h2>
            <p class="text-muted">Welcome back! Here's your business at a glance</p>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row g-3">
        <!-- Product Card -->
        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="card border-0 shadow-sm hover-shadow transition-all h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-primary-subtle me-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                <line x1="8" y1="21" x2="16" y2="21"></line>
                                <line x1="12" y1="17" x2="12" y2="21"></line>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-weight-bold mb-0" id="product"></h3>
                            <p class="text-muted text-sm mb-0">Total Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Card -->
        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="card border-0 shadow-sm hover-shadow transition-all h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-success-subtle me-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success">
                                <path d="M3 3h18v18H3z"></path>
                                <path d="M21 9H3"></path>
                                <path d="M21 15H3"></path>
                                <path d="M12 3v18"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-weight-bold mb-0" id="category"></h3>
                            <p class="text-muted text-sm mb-0">Categories</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Card -->
        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="card border-0 shadow-sm hover-shadow transition-all h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-info-subtle me-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-info">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-weight-bold mb-0" id="customer"></h3>
                            <p class="text-muted text-sm mb-0">Total Customers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Card -->
        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="card border-0 shadow-sm hover-shadow transition-all h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-warning-subtle me-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-warning">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-weight-bold mb-0" id="invoice"></h3>
                            <p class="text-muted text-sm mb-0">Invoices</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Sale Card -->
        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
            <div class="card border-0 shadow-sm hover-shadow transition-all h-100 bg-gradient-blue text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-white bg-opacity-25 me-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-weight-bold mb-1 text-light">$<span id="total"></span></h3>
                            <p class="text-warning text-sm mb-0" id="totalSales">Total Sales</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- VAT Collection Card -->
        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
            <div class="card border-0 shadow-sm hover-shadow transition-all h-100 bg-gradient-purple text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-white bg-opacity-25 me-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-weight-bold mb-1 text-light">$<span id="vat"></span></h3>
                            <p class="text-warning text-sm mb-0">VAT Collection</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Collection Card -->
        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
            <div class="card border-0 shadow-sm hover-shadow transition-all h-100 bg-gradient-green text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-white bg-opacity-25 me-3 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-weight-bold mb-1 text-light">$<span id="payable"></span></h3>
                            <p class="text-warning text-sm mb-0">Total Collection</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS -->
    <style>
        /* Base styles */
        .dashboard-container {
            background-color: #f8f9fa;
            min-height: 100%;
        }

        .card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .text-lg {
            font-size: 1.5rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        /* Icon styles */
        .icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Gradient backgrounds */
        .bg-gradient-blue {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .bg-gradient-purple {
            background: linear-gradient(135deg, #7c69ef 0%, #5a41ea 100%);
        }

        .bg-gradient-green {
            background: linear-gradient(135deg, #36b9cc 0%, #1a8a9e 100%);
        }

        /* Bootstrap-like utilities */
        .bg-primary-subtle {
            background-color: rgba(78, 115, 223, 0.15);
        }

        .bg-success-subtle {
            background-color: rgba(40, 167, 69, 0.15);
        }

        .bg-info-subtle {
            background-color: rgba(54, 185, 204, 0.15);
        }

        .bg-warning-subtle {
            background-color: rgba(246, 194, 62, 0.15);
        }

        .bg-opacity-25 {
            opacity: 0.25;
        }


    </style>
</div>



<script>


    getSummary();

    async function getSummary(){

        showLoader();
        let res = await axios.get('/dashboardSummary');
        hideLoader();

        if(res.status === 200){
            document.getElementById('product').innerHTML = res.data['product'];
            document.getElementById('category').innerHTML = res.data['category'];
            document.getElementById('customer').innerHTML = res.data['customer'];
            document.getElementById('invoice').innerHTML = res.data['invoice'];
            document.getElementById('total').innerHTML =  res.data['total'];
            document.getElementById('vat').innerHTML = res.data['vat'];
            document.getElementById('payable').innerHTML = res.data['payable'];
        }else{
            errorToast('Dashboard Data Not Found!!');
        }


    }
</script>





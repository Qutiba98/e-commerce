

<!DOCTYPE php>
<php lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, php, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
<!-- إضافة مكتبة Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Electro Admin Dashboard</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">Electro</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="index.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					

				
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------ -->
					
					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-manage-users.php">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-manage-categories.php">
              <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Manage categories</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-view-sales.php">
              <i class="align-middle" data-feather="package"></i> <span class="align-middle">View Sales</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-manage-products.php">
              <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Manage Products</span>
            </a>
					</li>
				</ul>
			</div>
		</nav>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------ -->

		<div class="main">
				<?php 
require "../db.php";
				?>
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
					<?php
							// استدعاء الاتصال بقاعدة البيانات
							global $conn;

							// الاستعلامات للحصول على إجمالي المستخدمين، المبيعات، المنتجات
							$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users";
							$totalSalesQuery = "SELECT SUM(amount) AS total_sales FROM payment_recipe"; // Assuming there's a `sales` table with `amount` field
							$totalProductsQuery = "SELECT COUNT(*) AS total_products FROM product";
							$totalOrdersQuery = "SELECT COUNT(*) AS total_orders FROM payment_recipe"; // Assuming there's an `orders` table

							// تنفيذ الاستعلامات
							$totalUsersResult = $conn->query($totalUsersQuery);
							$totalSalesResult = $conn->query($totalSalesQuery);
							$totalProductsResult = $conn->query($totalProductsQuery);
							$totalOrdersResult = $conn->query($totalOrdersQuery);

							// الحصول على النتائج
							$totalUsers = $totalUsersResult->fetch_assoc()['total_users'];
							$totalSales = $totalSalesResult->fetch_assoc()['total_sales'];
							$totalProducts = $totalProductsResult->fetch_assoc()['total_products'];
							$totalOrders = $totalOrdersResult->fetch_assoc()['total_orders'];

						?>
						
					<div class="row">
    <div class="col-xl-6 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row" style="width:100%; hight:100%">
                <div class="col-sm-6" >
                   
				<div class="card" style="height:60%">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Users</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3"><?php echo $totalUsers; ?></h1>
                            <div class="mb-0">
                                <span class="text-muted">Current registered users</span>
                            </div>
                        </div>
						
                    </div>


                    <div class="card" style="height:60%">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Sales</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3"><?php echo $totalSales; ?></h1>
                            <div class="mb-0">
                                <span class="text-muted">Sales since the beginning</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="card" style="height:60%">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Products</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="package"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3"><?php echo $totalProducts; ?></h1>
                            <div class="mb-0">
                                <span class="text-muted">Products available</span>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="height:60%" >
                        <div class="card-body" >
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Orders</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3"><?php echo $totalOrders; ?></h1>
                            <div class="mb-0">
                                <span class="text-muted">Orders since the beginning</span>
                            </div>
                        </div>
                    </div>
                </div>


								</div>
							</div>
						</div>
					<div class="col-sm-6" style="width:58% ;float:right">
								<div class="card flex-fill">
									<div class="card-header">
										<h5 class="card-title mb-0">Calendar</h5>
									</div>
									<div class="card-body d-flex">
										<div class="align-self-center w-100">
											<div class="chart">
												<div id="datetimepicker-dashboard"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
<!-- ---------------------------------------------------------------------------------------------------------------------------------- -->
<div class="row" >
<div class="col-xl-6 col-xxl-7" style="width:100% ">
							<div class="card flex-fill w-100">
								<div class="card-header">					
<h5 class="card-title mb-0">Recent Movement</h5>
</div>
<div class="card-body py-3">
    <div class="chart chart-sm">
        <canvas id="chartjs-dashboard-line"></canvas>
    </div>
</div>
</div>
</div>
</div>

<script>
   document.addEventListener("DOMContentLoaded", function() {
    fetch('fetch_sales_data.php')
        .then(response => response.json())
        .then(data => {
            var dates = data.dates;
            var sales = data.sales;

            var ctx = document.getElementById('chartjs-dashboard-line').getContext('2d');

            // إذا كان هناك رسم بياني موجود، قم بتدميره
            if (window.myChart) {
                window.myChart.destroy();
            }

            // إنشاء الرسم البياني الجديد
            window.myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Total Sales',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        data: sales
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Sales Amount'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});

</script>

  <!-- إضافة مكتبة Flatpickr -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // الحصول على التاريخ الحالي
        var currentDate = new Date();

        // تفعيل التقويم مع عرض التاريخ الحالي
        flatpickr("#datetimepicker-dashboard", {
            defaultDate: currentDate, // عرض التاريخ الحالي بشكل افتراضي
        });
    </script>
</div>
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

					

	<div class="row">
						

					
												
	</div>

				</div>
			</main>


	<script src="js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
		// جلب البيانات من ملف PHP باستخدام AJAX
		fetch('fetch_sales_data.php') // استبدل هذا المسار بالمسار الصحيح لملف PHP
			.then(response => response.json())
			.then(data => {
				var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
				var gradient = ctx.createLinearGradient(0, 0, 0, 225);
				gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
				gradient.addColorStop(1, "rgba(215, 227, 244, 0)");

				new Chart(document.getElementById("chartjs-dashboard-line"), {
					type: "line",
					data: {
						labels: data.dates, // استخدم التواريخ من قاعدة البيانات
						datasets: [{
							label: "Sales ($)",
							fill: true,
							backgroundColor: gradient,
							borderColor: window.theme.primary,
							data: data.sales // استخدم بيانات المبيعات من قاعدة البيانات
						}]
					},
					options: {
						maintainAspectRatio: false,
						legend: {
							display: false
						},
						tooltips: {
							intersect: false
						},
						hover: {
							intersect: true
						},
						plugins: {
							filler: {
								propagate: false
							}
						},
						scales: {
							xAxes: [{
								reverse: true,
								gridLines: {
									color: "rgba(0,0,0,0.0)"
								}
							}],
							yAxes: [{
								ticks: {
									stepSize: 1000
								},
								display: true,
								borderDash: [3, 3],
								gridLines: {
									color: "rgba(0,0,0,0.0)"
								}
							}]
						}
					}
				});
			});
	});
		
	</script>

	   <!-- إضافة مكتبة Flatpickr -->
	   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

	   <script>
    document.addEventListener("DOMContentLoaded", function() {
        // إعداد التقويم باستخدام Flatpickr
        document.getElementById("datetimepicker-dashboard").flatpickr({
            inline: true,
            prevArrow: "<span title=\"Previous month\">&laquo;</span>",
            nextArrow: "<span title=\"Next month\">&raquo;</span>",
            defaultDate: new Date() // تعيين التاريخ الافتراضي ليكون تاريخ اليوم
        });
    });
</script>


	<script>
		// document.addEventListener("DOMContentLoaded", function() {
		// 	var markers = [{
		// 			coords: [31.230391, 121.473701],
		// 			name: "Shanghai"
		// 		},
		// 		{
		// 			coords: [28.704060, 77.102493],
		// 			name: "Delhi"
		// 		},
		// 		{
		// 			coords: [6.524379, 3.379206],
		// 			name: "Lagos"
		// 		},
		// 		{
		// 			coords: [35.689487, 139.691711],
		// 			name: "Tokyo"
		// 		},
		// 		{
		// 			coords: [23.129110, 113.264381],
		// 			name: "Guangzhou"
		// 		},
		// 		{
		// 			coords: [40.7127837, -74.0059413],
		// 			name: "New York"
		// 		},
		// 		{
		// 			coords: [34.052235, -118.243683],
		// 			name: "Los Angeles"
		// 		},
		// 		{
		// 			coords: [41.878113, -87.629799],
		// 			name: "Chicago"
		// 		},
		// 		{
		// 			coords: [51.507351, -0.127758],
		// 			name: "London"
		// 		},
		// 		{
		// 			coords: [40.416775, -3.703790],
		// 			name: "Madrid "
		// 		}
		// 	];
		// 	var map = new jsVectorMap({
		// 		map: "world",
		// 		selector: "#world_map",
		// 		zoomButtons: true,
		// 		markers: markers,
		// 		markerStyle: {
		// 			initial: {
		// 				r: 9,
		// 				strokeWidth: 7,
		// 				stokeOpacity: .4,
		// 				fill: window.theme.primary
		// 			},
		// 			hover: {
		// 				fill: window.theme.primary,
		// 				stroke: window.theme.primary
		// 			}
		// 		},
		// 		zoomOnScroll: false
		// 	});
		// 	window.addEventListener("resize", () => {
		// 		map.updateSize();
		// 	});
		// });
	</script>
	


</body>

</php>
@extends('admin/layouts.app')

@section('content')

<main class="content">
				<div class="container-fluid p-0">

                	<h1 class="h3 mb-3"><strong>Spot</strong> Dashboard</h1>
				
						<div class="row">
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Reservations</h5>
											</div>

											<div class="col-auto">
												<div class="stat text-primary">
													<i class="align-middle" data-feather="calendar"></i>
												</div>
											</div>
										</div>
										<h1 class="mt-1 mb-3">{{App\Models\Reservation::count()}}</h1>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Venues</h5>
											</div>
											<div class="col-auto">
												<div class="stat text-primary">
													<i class="align-middle" data-feather="home"></i>
												</div>
											</div>
										</div>
										<h1 class="mt-1 mb-3">{{App\Models\Venue::count()}}</h1>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Users</h5>
											</div>
											<div class="col-auto">
												<div class="stat text-primary">
													<i class="align-middle" data-feather="users"></i>
												</div>
											</div>
										</div>
										<h1 class="mt-1 mb-3">{{App\Models\User::where('user_type', 'user')->count()}}</h1>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Staff</h5>
											</div>
											<div class="col-auto">
												<div class="stat text-primary">
													<i class="align-middle" data-feather="briefcase"></i>
												</div>
											</div>
										</div>
										<h1 class="mt-1 mb-3">{{App\Models\User::where('user_type', 'admin')->count()}}</h1>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card flex-fill w-100">
									<div class="card-header">
										<h5 class="card-title mb-0">Venue Usage</h5>
									</div>
									<div class="card-body d-flex">
										<div class="align-self-center w-100">
											<div class="py-3">
												<div class="chart chart-xs">
													<canvas id="chartjs-dashboard-pie"></canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card flex-fill w-100">
									<div class="card-header">
										<h5 class="card-title mb-0">Reservations Overview</h5>
									</div>
									<div class="card-body py-3">
										<div class="chart chart-sm">
											<canvas id="chartjs-dashboard-line"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>


@endsection
<script>
		document.addEventListener("DOMContentLoaded", function() {
			var _labels={!! json_encode($labels) !!};
			var _data={!! json_encode($data) !!};
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: _labels,
					datasets: [{
						label: "Reservations",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: _data
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
</script>
<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			var _plabels = {!! json_encode($plabels) !!};
			var _pdata = {!! json_encode($pdata) !!};

			var chartColors = [
				window.theme.primary,
				window.theme.warning,
				window.theme.danger
			];

			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: _plabels,
					datasets: [{
						data: _pdata,
						backgroundColor: chartColors,
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: true,
						position: 'right', // You can change the position as needed
						labels: {
							fontColor: 'rgba(0,0,0,0.8)' // Adjust the font color as needed
						}
					},
					cutoutPercentage: 75
				}
			});

		});
</script>
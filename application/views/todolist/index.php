<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<link rel="stylesheet" href="<?= base_url('assets/fa/css/all.css') ?>">
	<title>Document</title>
	<script src="<?= base_url('assets/js/jquery-2.1.1.min.js') ?>"></script>
</head>




<body>
	<section id="faq">
		<?php var_dump($this->session->userdata('data')['id']) ?>
		<main id="main">
			<div class="timer">
				<div class="container">
					<div class="col-md-6 col-md-offset-3">
						<div class="text-center">
							<!-- Countdown dashboard start -->
							<div id="countdown_dashboard">
								<div class="countDown">
									<br><br><br>
									<h3>Your due date</h3>
									<div class="dash days_dash">
										<span class="dash_title" style="color: black">days</span>
										<div class="digit">0</div>
										<div class="digit">0</div>
									</div>

									<div class="dash hours_dash">
										<span class="dash_title" style="color: black">hours</span>
										<div class="digit">0</div>
										<div class="digit">0</div>
									</div>

									<div class="dash minutes_dash">
										<span class="dash_title" style="color: black">minutes</span>
										<div class="digit">0</div>
										<div class="digit">0</div>
									</div>

									<div class="dash seconds_dash">
										<span class="dash_title" style="color: black">seconds</span>
										<div class="digit">0</div>
										<div class="digit">0</div>
									</div>
								</div>
							</div>
							<!-- Countdown dashboard end -->
						</div>
					</div>
				</div>
			</div>
	</section><!-- #intro -->
	<div>
		<div class="container">
			<div class="content">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<header class="section-header">
							<h3>To Do List</h3>
						</header>
						<div class="card">
							<div class="card-header">
								<center>
									<h3 class="card-title">Timeline</h3>

									<div class="row">
										<div class="col-md-6">
											<input id="l" class="form-control" type="text" placeholder="Add lists ...">
										</div>
										<div class="col-md-6">
											<input type="date" id="date" class="form-control">
										</div>
									</div>
									<br />
									<div class="row">
										<div class="col-md">
											<button style="width:100%" onclick="add_list()" class="btn btn-primary">Add</button>
										</div>
									</div>



								</center>
								<br><br>
							</div>
							<!-- <div class="card-body">
								<div class="table-responsive">
									<table class="table">
										<thead class=" text-primary">
											<th>No</th>
											<th>Task</th>
											<th>Action</th>
										</thead>
										<tbody id="list">


										</tbody>
									</table>
								</div>
							</div> -->

						</div>
						<br>
						<div class="row" id="list">
							<!-- start looping in js -->


							<!-- end looping -->
						</div>
					</div>
				</div>
				<script>
					var $data = $('#list')
					// console.log(data)
					var no = 1;
					var items = []


					$.ajax({
						method: "get",
						url: "http://localhost/ewedding/api_todolist/list/" + <?= $this->session->userdata('data')['id'] ?>,
						success: function(lists) {
							$.each(lists, function(i, list) {
								items.push(list)

								// no++

							})
							const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
							for (var i = 0; i < items.length; i++) {

								if (i == 0) {
									$data.append(`
										<div class="col-md-6" style="margin-top:30px;">
											<div class="card">
												<div class="card-title" style="padding:15px;">
													<center><b>${months[parseInt(items[i].tgl.split('-')[1])-1]}</b></center>
												</div>
												<table class="table" style="margin-top:-10px;">
													<tr>
														<th>Task</th>
														<th>Date</th>
														<th>Action</th>
													</tr>
													<tbody id="card-list-${i}">
														<tr>
															<td>
																${items[i].status == 1 ? `<span style="text-decoration:line-through">${items[i].list}</span>` : `<span>${items[i].list}</span>`}
															</td>
															<td>${items[i].tgl}</td>
															<td> 
																${items[i].status == 0 ? `<span onclick="edit_list(${items[i].id_todolist})" style="cursor:pointer" class="label label-primary"><i class="fas fa-check"></i> </span><span onclick="remove_list(${items[i].id_todolist})" style="cursor:pointer" class="label label-danger"><i class="fas fa-trash"></i> </span>` : `<span onclick="remove_list(${items[i].id_todolist})" style="cursor:pointer" class="label label-danger"><i class="fas fa-trash"></i> </span>`} 
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										`)
									// console.log('masih 0')
								} else if (parseInt(items[i - 1].tgl.split('-')[1]) == parseInt(items[i].tgl.split('-')[1])) {
									$('#card-list-' + (i - 1)).append(`
										<tr>
										<td>${items[i].status == 1 ? `<span style="text-decoration:line-through">${items[i].list}</span>` : `<span>${items[i].list}</span>`}</td>
										<td>${items[i].tgl}</td>
										<td>
											${items[i].status == '0' ? `<span onclick="edit_list(${items[i].id_todolist})" style="cursor:pointer" class="label label-primary"><i class="fas fa-check"></i> </span><span onclick="remove_list(${items[i].id_todolist})" style="cursor:pointer" class="label label-danger"><i class="fas fa-trash"></i> </span>` : `<span onclick="remove_list(${items[i].id_todolist})" style="cursor:pointer" class="label label-danger"><i class="fas fa-trash"></i> </span>`} </td>
										</tr>
									`)
								} else {
									$data.append(`
										<div class="col-md-6" style="margin-top:30px;">
											<div class="card">
												<div class="card-title" style="padding:15px;">
													<center><b>${months[parseInt(items[i].tgl.split('-')[1])-1]}</b></center>
												</div>
												<table class="table" style="margin-top:-10px;">
													<tr>
														<th>Task</th>
														<th>Date</th>
														<th>Action</th>
													</tr>
													<tbody id="card-list-${i}">
														<tr>
															<td>${items[i].status == 1 ? `<span style="text-decoration:line-through">${items[i].list}</span>` : `<span>${items[i].list}</span>`}</td>
															<td>${items[i].tgl}</td>
															<td>${items[i].status == 0 ? `<span onclick="edit_list(${items[i].id_todolist})" style="cursor:pointer" class="label label-primary"><i class="fas fa-check"></i> </span>
															<span onclick="remove_list(${items[i].id_todolist})" style="cursor:pointer" class="label label-danger"><i class="fas fa-trash"></i> </span>` : `<span onclick="remove_list(${items[i].id_todolist})" style="cursor:pointer" class="label label-danger"><i class="fas fa-trash"></i> </span>`} </td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									`)
								}
							}

						}
						// console.log(index)



					})

					function add_list() {
						const data_list = {
							list: $('#l').val(),
							date: $('#date').val(),
							id_user: <?= $this->session->userdata('data')['id'] ?>,

						}
						$.ajax({
							method: "post",
							url: "http://localhost/ewedding/api_todolist/list",
							data: data_list,
							success: window.location.reload(true)
						})
					}

					function remove_list(id) {
						$.ajax({
							method: "DELETE",
							url: "http://localhost/ewedding/api_todolist/list",
							data: {
								id_todolist: id,
							},
							success: window.location.reload(true)
						})
					}

					function edit_list(id) {
						$.ajax({
							method: "PUT",
							url: "http://localhost/ewedding/api_todolist/list",
							data: {
								id_todolist: id,
								status: 1,
							},
							success: window.location.reload(true)
						})
					}
				</script>
</body>

</html>
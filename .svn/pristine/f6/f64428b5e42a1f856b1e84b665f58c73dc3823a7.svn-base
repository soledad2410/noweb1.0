<section>
	<nav role="navigation" class="navbar navbar-inverse">
		<div class="navbar-header">
			<a href="/cp/tags" class="navbar-brand">Danh sách khối nội dung website</a>
		</div>
	</nav>
	<!-- page start-->
	<div class="row">
		<div class="col-md-4">
			<section class="panel">
				<header class="panel-heading">
					Các layout đang hoạt động
				</header>
				<div class="panel-body">
					<ul class="nav prod-cat">

					</ul>
				</div>
			</section>
		</div>
		<div class="col-md-8">
			<section class="panel">
				<header class="panel-heading">
					Danh sách vị trí
				</header>
				<div class="panel-body">
					@if ($allWidget)
					<form id="form-list-products-table">
						<table class="display table-hover table table-bordered dataTable news-list-table" id="list-products-table">
							<thead>
								<tr>
									<td class="sort" data-value="name">Tên vị trí</td>
									<td>Mô tả</td>
									<td class="sort" data-value="status">Trạng thái</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($allWidget as $item)
								<tr>
									<td>{{$item['name']}}</td>
									<td>{{$item['details']}}</td>
									<td>
										<div class="btn-group">
											<a data-toggle="dropdown" href="javascript:;">
												<i class="icon-ok"></i> Đã đăng
											</a>
											<ul class="dropdown-menu choose-edit btn-sm">
												<li>
													<a href="javascript:;" data-rel="1" onclick="change_status(1, 1);">
														<i class="icon-ok"></i> Đăng
													</a>
												</li>
												<li>
													<a href="javascript:;" data-rel="1" onclick="change_status(1, 2);">
														<i class="icon-circle-arrow-down"></i> Hạ
													</a>
												</li>
												<li class="divider"></li>
												<li>
													<a onclick="showEditProductForm(1)" href="javascript:;" data-rel="1">
														<i class="icon-pencil"></i> Sửa nhanh
													</a>
												</li>
												<li>
													<a class="adv-edit" href="javascript:;" data-rel="1">
														<i class="icon-pencil"></i> Sửa chi tiết
													</a>
												</li>
												<li>
													<a class="copy-product" href="javascript:;" data-rel="1"><i class="icon-copy"></i> Sao chép
													</a>
												</li>
												<li>
													<a class="delete-product" data-rel="1" href="javascript:;"><i class="icon-remove"></i> Xóa
													</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</form>
					@endif
				</div>
			</section>
		</div>
	</div>
	<!-- page end-->
</section>
<!--script for this page only-->
<script type="text/javascript" src="{{$resources_path}}/js/widget.js"></script>
<!-- END JAVASCRIPTS -->
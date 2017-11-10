@extends("layouts.admin")



@section("section")

<div class="main-container">
			<div class="container-fluid">
				<div class="page-breadcrumb">
					<div class="row">
						<div class="col-md-7">
							<div class="page-breadcrumb-wrap">
								<div class="page-breadcrumb-info">
									<h2 class="breadcrumb-titles font"> 创建展览 <small> 面板 </small></h2>
									<ul class="list-page-breadcrumb">
										<li><a href="#">Home</a>
										</li>
										<li class="active-page"> 创建展览 </li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-5">
                           <div class="btn-group pull-right " style="margin-top:30px;">
                                <a  href='{{url('admin/device/store')}}' type="button" class="btn btn-default font"><i class="ico-plus"></i> 创建新的展览</a>
                            </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box-widget widget-module no-border">
							<div class="widget-container">
								<div class=" widget-block">
									<div class="page-header">
										<h2 class="font">创建一个新的展览</h2>
										<p class="font">
											你可以通过下面的表单创建一个新的展览 。
										</p>
									</div>
									<form id="SignUpForm"  class="form-horizontal" action="{{url('admin/exhibit')}}" method="post" >
                                        {{csrf_field()}}
										<div class="form-group">
											<label class="col-lg-3 control-label font">分组名称</label>
											<div class="col-lg-4">
												<input type="text" class="form-control" name="pname" placeholder="展览主题"  required />
											</div>
										</div>
                                        <div class="form-group">
											<div class="col-lg-4 col-lg-offset-3">
												<input type="submit" class="form-control btn btn-success "  value="确认添加"  />
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>






@endsection
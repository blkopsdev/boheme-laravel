@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title ">@lang('app.users')</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 text-right">
								<a href="{{ route('add_user') }}" class="btn btn-sm btn-primary">@lang('app.add_user')</a>
							</div>
            </div>
            @if (session('status'))
              <div class="row">
                <div class="col-sm-12">
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>{{ session('status') }}</span>
                  </div>
                </div>
              </div>
            @endif
						<div class="table-responsive">
							<table class="table">
								<thead class=" text-primary">
									<tr>
										<th>@lang('app.name')</th>
										<th>@lang('app.email')</th>
										<th>@lang('app.created_at')</th>
										<th class="text-right">@lang('app.action')</th>
									</tr>
								</thead>
								<tbody>
                  @foreach ($users as $user)
									<tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{date('m-d-Y h:i', strtotime($user->created_at))}}</td>
										<td class="td-actions text-right">
											<a rel="tooltip" class="btn btn-success btn-link" href="{{route('edit_user', $user->id)}}"
												data-original-title="" title="@lang('app.edit_user')">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
                      </a>
										</td>
									</tr>
                  @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

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
								<a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">@lang('app.add_user')</a>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table">
								<thead class=" text-primary">
									<tr>
										<th>@lang('app.name')</th>
										<th>@lang('app.email')</th>
										<th>{{ __('User Type') }}</th>
										<th>{{ __('Created On') }}</th>
										<th class="text-right">@lang('app.action')</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($users as $user)
									<tr>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{ ucfirst($user->user_type) }}</td>
										<td>{{date('m/d/Y', strtotime($user->created_at))}}</td>
										<td class="td-actions text-right d-flex">
											<a rel="tooltip" class="btn btn-success btn-link" href="{{route('users.edit', $user->id)}}"
												data-original-title="" title="@lang('app.edit_user')">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<form action="{{ route('users.destroy', $user->id) }}" method="POST" >
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger btn-link" onclick="return confirm('Are you sure you want to permanently delete User #{{ $user->id }}?')" rel="tooltip" data-original-title="" title="{{ __('Delete') }}"><i class="material-icons">delete</i></button>
											</form>
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
@push('js')
	
<script>
	@if(session('success'))
		toastr.success('{{ session('success') }}', '{{ trans('app.success') }}', toastr_options);
	@endif
	@if(session('error'))
		toastr.error('{{ session('error') }}', '{{ trans('app.error') }}', toastr_options);
	@endif
</script>
@endpush
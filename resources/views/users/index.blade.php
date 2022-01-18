@extends('layouts.spaces.dashboard', ['activePage' => 'user-management', 'titlePage' => __('User Management'), 'activePanel' => 'dashboard'])

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-header-success">
						<h4 class="card-title ">@lang('app.users')</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 text-right">
								<a href="{{ route('add_user') }}" class="btn btn-sm btn-success">@lang('app.add_user')</a>
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
								<thead class=" text-dark">
									<tr>
										<th>@lang('app.name')</th>
										<th>@lang('app.email')</th>
										<th>@lang('app.created_at')</th>
										<th>@lang('app.project_amount')</th>
										<th class="text-right">@lang('app.action')</th>
									</tr>
								</thead>
								<tbody>
                  @foreach ($users as $user)
									<tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
										<td>{{date('m-d-Y h:i', strtotime($user->created_at))}}</td>
										<td>{{ $user->projects->count() }}</td>
										<td class="td-actions text-right">
											<a class="btn btn-link" href="{{route('edit_user', $user->id)}}">
												<i class="material-icons">edit</i>
											</a>
											<button class="btn btn-danger btn-link" id="delete" data-id="{{$user->id}}"><i class="material-icons">delete</i></button>
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
	$(document).on('click', '#delete', function() {
		if (!confirm('{{ trans('app.are_you_delete_user') }}')) {
			return '';
		}
		var user_id = $(this).data('id');
		$.ajax({
			url: "{{ route('user_delete') }}",
			type: "POST",
			data: {
				_token: "{{ csrf_token() }}",
				user_id: user_id
			},
			success: function(data){
				toastr.success(data.msg, '@lang('app.success')', toastr_options);
				location.reload();
			}
		})
	});
</script>
@endpush
@extends('todo.layouts.app')

@section('content')
	<div class="container" style="font-family: 'Raleway', sans-serif;">
		<div class="col-md-offset-2 col-md-8">
			<div class="panel panel-default">
				<div class="panel-body">
					@if (Session::has('success'))
					<div class="alert alert-success">
						<strong>Success:</strong> {{Session::get('success')}}
					</div>
					@endif

					@if(count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Error:</strong>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="row">
						<form action="{{ route('store')}}" method="POST">
							{{ csrf_field() }}
							<div class="col-md-9">
								<input type="text" name="newTaskName" class="form-control">
							</div>
							<div class="col-md-3">
								<input type="submit" class="btn btn-primary btn-block" value="Add Task">
							</div>
						</form>
					</div>

					<table class="table" style="margin-top:10px;">
						<thead>
							<th>Task</th>
							<th>Name</th>
							<th>Edit</th>
							<th>Done</th>
							<th>Delete</th>
						</thead>
						<tbody>
							@foreach ($items as $item)
							<tr>
								<td>{{ $item->id }}</td>
								<td>{{ $item->name }}</td>
								<td>
									<form action="{{ route('store') }}" method="POST">
										{{ csrf_field() }}
										<input type="checkbox" name="item" id="item_{{ $item->id }}" {{ $item->done ? 'checked' : '' }} onClick="this.form.submit()">
										<input type="hidden" name="item_id" value="{{ $item->id }}">
									</form>
								</td>
								<td>
									<a href="{{ route('edit', ['item' => $item->id]) }}" class="btn btn-default">Edit</a>
								</td>
								<td>
									<span>
										<a href="{{ url('/todo/delete', $item->id) }}" class="btn btn-danger">Delete</a>
									</span>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
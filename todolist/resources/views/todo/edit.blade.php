@extends('todo.layouts.app')

@section('content')
	<div class="container">
		<div class="col-md-offset-2 col-md-8">
			<div class="row">
				<h1>Todo List</h1>
			</div>
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
				<form action="{{ route('update', ['itemUnderEdit' => $itemUnderEdit->id]) }}" method="POST">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">
				<div class="form-group">
					<input type="text" name="updatedItemName" value=" {{ $itemUnderEdit->name }} "class="form-control input-lg">
				</div>
				<div class="form-group">
					<input type="submit" name="" value="Save" class="btn btn-success">
					<a href="{{ route('todo') }}" class="btn btn-default pull-right">Back</a>
				</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@extends('todo.layouts.app')

@section('content')
	@foreach($errors->all() as $error)
		<div class="errors"> {{ $error }} </div>
	@endforeach
	{{ Form::open() }}
		<input type="text" name="name" placeholder="Task Name">
		<button type="submit">Create</button>
	{{ Form::close() }}
@endsection
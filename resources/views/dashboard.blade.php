@extends('layout')



@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">{{ __('Dashboard') }}</div>



                <div class="card-body">

                    @if (session('success'))

                    <div class="alert alert-success" role="alert">

                        {{ session('success') }}

                    </div>

                    @endif



                    You are Logged In

                </div>

            </div>

            <!-- Task Form -->
            <div class="card mb-4">
                <div class="card-header">Add New Task</div>
                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Task Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Add Task</button>
                    </form>
                </div>
            </div>

            <!-- Task List -->
            <div class="card">
                <div class="card-header">Your Tasks</div>
                <div class="card-body">
                    @if($tasks->count())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No tasks found. Start by adding one!</p>
                    @endif
                </div>
            </div>

        </div>

    </div>

</div>

@endsection
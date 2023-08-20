@extends('layouts.layout')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thêm mới </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form</h6>
        </div>
        <div class="card-body">
            <form  action="{{route('courses.update',$model)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$model->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{$model->price}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">start_date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{$model->start_date}}">
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">end_date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{$model->end_date}}">
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label for="image" class="form-label">image</label>
                            <input type="file" class="form-control" id="image" name="image" value="{{$model->image}}">
                            <img width="150px" src="{{asset('storage/'.$model->image)}}" alt="">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


@endsection

@extends('layouts.layout')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                                                                       href="https://datatables.net">official DataTables
                documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>price</th>
                            <th>start_date</th>
                            <th>end_date</th>
                            <th>image</th>
                            <th>Action</th>


                        </tr>
                        </thead>

                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->start_date}}</td>
                                <td>{{$item->end_date}}</td>
                                <td><img width="150px" src="{{asset('storage/'.$item->image)}}" alt=""></td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('courses.edit',$item)}}">Edit</a>
                                    <button class="btn btn-danger" onclick="if (confirm('xoas ko ban')){
                                        document.getElementById('item-{{$item->id}}').submit();
                                    }">Delete</button>
                                    <form action="{{route('courses.destroy',$item)}}" id="item-{{$item->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
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
    <!-- /.container-fluid -->
@endsection

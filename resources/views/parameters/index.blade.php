@extends('layouts.app')
@section('content')
    <div class="row-cols-6 d-flex justify-content-center align-self-center d-grid gap-1 mb-5">
        <form action="" method="GET" class="d-flex flex-column justify-content-center">
            <input class="form-control mr-2 mb-2" type="search" placeholder="Поиск параметров по ID" aria-label="Поиск параметров по ID" name="id">
            <input class="form-control mr-2" type="search" placeholder="Поиск параметров по Title" aria-label="Поиск параметров по Title" name="title">
            <button class="btn btn-outline-success mt-2" type="submit">Поиск</button>
        </form>
    </div>
    @can('view', auth()->user())
        <div class="row-cols-12 align-self-center d-grid gap-1 mb-3">
            <a href="{{route('performers.create')}}" class="btn btn-primary" type="button">Добавить исполнителя</a>
        </div>
    @endcan
    @if($parameters->isEmpty())
        <div class="row-cols-6 d-flex justify-content-center align-self-center d-grid gap-1 mb-5 text-danger">
            Список параметров пуст
        </div>
    @else
        <table class="table table-borderless">
            <thead>
            <tr>
                <th scope="col" style="text-align: center">#</th>
                <th scope="col" style="text-align: center">Параметр</th>
                <th scope="col" style="text-align: center"v>icon</th>
                <th scope="col" style="text-align: center">icon_gray</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parameters as $parameter)
                <tr>
                    <th scope="row">{{$parameter->id}}</th>
                    <td>{{$parameter->title}}</td>
                    @if($parameter->type == '2')
                        @if(isset($parameter->icon))
                            <td>
                                <div class="container d-flex justify-content-center align-self-center">
                                    <img src="{{ asset('storage/app/public').'/'.$parameter->icon }}" style="max-height: 20%; max-width: 60%">
                                    <form class="d-flex justify-content-center align-self-center" action="{{ route('delete', ['icon', $parameter->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn p-4 rounded-10" style="font-size: 12px;padding: 5px 5px !important; opacity: 0.7;top: 80%;left: 50%;">Delete</button>
                                    </form>
                                </div>
                                <form class="d-flex justify-content-center align-self-center" action="{{ route('upload', ['icon', $parameter->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file">
                                    <button class="btn btn-primary" type="submit">Update File</button>
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('upload', ['icon', $parameter->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file">
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                </form>
                            </td>
                        @endif
                        @if(isset($parameter->icon_gray))
                            <td>
                                <div class="container d-flex justify-content-center align-self-center">
                                    <img src="{{ asset('storage/app/public').'/'.$parameter->icon_gray }}" style="max-height: 20%; max-width: 60%">
                                    <form class="d-flex justify-content-center align-self-center" action="{{ route('delete', ['icon_gray', $parameter->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn p-4 rounded-10" style="font-size: 12px;padding: 5px 5px !important; opacity: 0.7;top: 80%;left: 50%;">Delete</button>
                                    </form>
                                </div>
                                <form class="d-flex justify-content-center align-self-center" action="{{ route('upload', ['icon_gray', $parameter->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file">
                                    <button class="btn btn-primary" type="submit">Update File</button>
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('upload', ['icon_gray', $parameter->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file">
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                </form>
                            </td>
                        @endif
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if(session('success'))
        <div class="row-cols-9 align-self-center mt-5">
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="row-cols-9 align-self-center mt-5">
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        </div>
    @endif
@endsection

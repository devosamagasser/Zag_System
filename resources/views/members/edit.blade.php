@extends('layouts.app')

@section('content')

    @if($errors->any)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger w-25 text-center mx-auto my-2">{{$error}}</div>
        @endforeach
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{$data['pageTitle']}}</h3>
        </div>
        <form action="{{route('positions.update',$data['position']['id'])}}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$data['position']['id']}}">
            <div class="card-body">
                <div class="form-group">
                    <label for="CommitteeName">Position Name</label>
                    <input type="text" class="form-control" name="name" id="CommitteeName" value="{{$data['position']['name']}}" placeholder="Committee Name">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

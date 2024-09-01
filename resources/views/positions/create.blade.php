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
        <form action="{{route('positions.store')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="CommitteeName">Position Name</label>
                    <input type="text" class="form-control" name="name" id="CommitteeName" placeholder="Committee Name">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

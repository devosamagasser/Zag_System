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
        <form action="{{route('committees.store')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="CommitteeName">Committee Name</label>
                    <input type="text" class="form-control" name="name" id="CommitteeName" placeholder="Committee Name">
                </div>
                <div class="form-group">
                    <label for="sections" class="form-label">Sections</label>
                    <select id="sections" name="section_id" class="form-control">
                            <option value="">.........</option>
                        @foreach(getSections() as $section)
                            <option value="{{$section['id']}}">{{$section['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

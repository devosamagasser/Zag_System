@extends('layouts.app')

@section('content')

    @if($errors->any)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger w-25 text-center mx-auto my-2">{{$error}}</div>
        @endforeach
    @endif
    <div class="card card-primary w-75 mx-auto ">
        <div class="card-header">
            <h3 class="card-title">{{$data['pageTitle']}}</h3>
        </div>
        <form action="{{route('members.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="Name">Member Name</label>
                    <input type="text" class="form-control" name="name" id="Name" placeholder="Member Name">
                </div>

                <div class="form-group">
                    <label for="Email">Member Email</label>
                    <input type="email" class="form-control" name="email" id="Email" placeholder="Member Email">
                </div>

                <div class="form-group">
                    <label for="Phone">Member Phone</label>
                    <input type="text" class="form-control" name="phone" id="Phone" placeholder="Member Phone">
                </div>

                <div class="form-group">
                    <label for="City">Member City</label>
                    <input type="text" class="form-control" name="city" id="City" placeholder="Member City">
                </div>

                <div class="form-group">
                    <label for="Faculty">Member Faculty</label>
                    <input type="text" class="form-control" name="faculty" id="Faculty" placeholder="Member Faculty">
                </div>

                <div class="form-group">
                    <label for="Year">Member Year</label>
                    <select id="Year" class="form-control" name="year">
                            <option value="1" selected>First Year</option>
                            <option value="2">Second Year</option>
                            <option value="3">third Year</option>
                            <option value="4">Forth Year</option>
                            <option value="5">Fifth Year</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="bd">Member Birthday</label>
                    <input type="date" class="form-control" name="birthday" id="bd" >
                </div>

                <div class="form-group">
                    <label for="Department">Member Department</label>
                    <input type="text" class="form-control" name="department" id="Department" placeholder="Member Department">
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

                <div class="form-group">
                    <label for="sections" class="form-label">Sections</label>
                    <select id="sections" name="position_id" class="form-control">
                        <option value="">.........</option>
                        @foreach(getPositions() as $position)
                            <option value="{{$position['id']}}">{{$position['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="committee" class="form-label">Committee</label>
                    <select id="committee" name="committee_id" class="form-control">
                        <option value="">.........</option>
                        @foreach(getCommittees() as $committee)
                            <option value="{{$committee['id']}}">{{$committee['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Member Image</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            <!-- /.card-body -->
            <div class="card-footer row">
                <button type="submit" class="btn btn-primary btn-lg col-6">Submit</button>
            </div>
        </form>
    </div>
@endsection

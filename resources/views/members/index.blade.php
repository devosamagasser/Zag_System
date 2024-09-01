@extends('layouts.app')

@section('content')
    <!-- Main content -->
    @if($errors->any)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger w-25 text-center mx-auto my-2">{{$error}}</div>
        @endforeach
    @endif
    <div class="card">
        <div class="card-header">
            <div class="card-title d-flex justify-content-between align-items-center w-100">
                <a href="{{ route('members.create') }}" class="btn btn-lg btn-primary text-light">
                    <i class="fa fa-plus-circle"></i> Add Member
                </a>
                <div>
                    <button type="button" class="btn btn-lg btn-success text-light mr-1" data-toggle="modal" data-target="#import">
                        <i class="fa fa-upload"></i> Import
                    </button>
                    <div class="modal fade" id="import">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Select Your Excel File
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form  action="{{ route('members.import') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-success">Import</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                    <a href="{{ route('members.export', [
                        'filter[position]' => request('filter.position'),
                        'filter[section]' => request('filter.section'),
                        'filter[committee]' => request('filter.committee')
                    ]) }}" class="btn btn-lg btn-success text-light">
                        <i class="fa fa-download"></i> Export
                    </a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="get" action="{{route('members.index')}}">
                    <div class="mb-3 row">
                        <div class="mb-3 col-sm-6 col-md-8 row">
                            <div class="mb-3 col-4">
                                <label for="section" class="form-label">Filter By Section</label>
                                <select id="section" class="form-control" name="filter[section]">
                                    <option value="">.....</option>
                                    @foreach(getSections() as $section)
                                        <option value="{{$section['id']}}" @if(request('filter')) @if(request('filter')['section'] == $section['id']){{'selected'}} @endif @endif>{{$section['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-4">
                                <label for="section" class="form-label">Filter By Comittee</label>
                                <select id="section" class="form-control" name="filter[committee]">
                                    <option value="">.....</option>
                                    @foreach(getCommittees() as $committee)
                                        <option value="{{$committee['id']}}" @if(request('filter')) @if(request('filter')['committee'] == $committee['id']){{'selected'}} @endif @endif>{{$committee['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-4">
                                <label for="section" class="form-label">Filter By Position</label>
                                <select id="section" class="form-control" name="filter[position]">
                                    <option value="">.....</option>
                                    @foreach(getPositions() as $position)
                                        <option value="{{$position['id']}}" @if(request('filter')) @if(request('filter')['position'] == $position['id']){{'selected'}} @endif @endif>{{$position['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-2 align-content-center">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                        <div class="col-sm-3 col-md-2 align-content-center">
                            @if(request('filter'))
                                <a href="{{route('members.index')}}" class="btn btn-secondary w-100">Remove Filter</a>
                            @endif
                        </div>
                    </div>
            </form>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">name</th>
                    <th class="text-center">email</th>
                    <th class="text-center">phone</th>
                    <th class="text-center">city</th>
                    <th class="text-center">faculty</th>
                    <th class="text-center">year</th>
                    <th class="text-center">department</th>
                    <th class="text-center">position</th>
                    <th class="text-center">committee</th>
                    <th class="text-center">Control</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data['members'] as $key => $member)
                    <tr>
                        <td class="text-center">{{++$key}}</td>
                        <td class="text-center">
                            <button type="button" class="btn text-primary" data-toggle="modal" data-target="#image{{$member['id']}}">
                                Image
                            </button>
                            <div class="modal fade" id="image{{$member['id']}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Member Photo</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{$member['images']}}" class="w-25 img-rounded">
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </td>
                        <td>{{$member['name']}}</td>
                        <td>{{$member['email']}}</td>
                        <td class="text-center">{{$member['phone']}}</td>
                        <td class="text-center">{{$member['city']}}</td>
                        <td class="text-center">{{$member['faculty']}}</td>
                        <td class="text-center">{{$member['year']}}</td>
                        <td class="text-center">{{$member['department']}}</td>
                        <td class="text-center">{{$member['position']['name']}}</td>
                        <td class="text-center">{{$member['committee']['committee']['name']}}</td>
                        <td>
                            <div class="d-flex row justify-content-lg-center">
                                <a href="{{route('members.edit',$member->id)}}" class="btn text-success "><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn text-danger" data-toggle="modal" data-target="#modal-default{{$member['id']}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <div class="modal fade" id="modal-default{{$member['id']}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Warning Message</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are You Sure You Need To Delete {{$member->name}}
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <form  action="{{route('members.destroy',$member['id'])}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{$member['id']}}">
                                                    <button type="submit" class="btn btn-danger">Yes , Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-secondary text-light text-center">There is no Data</div>
                @endforelse

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </div>
    </div>
    <!-- /.content -->
@endsection

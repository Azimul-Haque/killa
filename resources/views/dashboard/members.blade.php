@extends('adminlte::page')

@section('title', 'Killa Consultancy | Members')

@section('css')

@stop

@section('content_header')
    <h1>
      Members
      <div class="pull-right">
        <a href="{{ route('dashboard.member.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Member</a>
      </div>
    </h1>
@stop

@section('content')
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email & Phone</th>
          <th>Designation</th>
          <th>Photo</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @php $addmodalflag = 0; $editmodalflag = 0; @endphp
        @foreach($members as $member)
        <tr>
          <td>{{ $member->name }}</td>
          <td>{{ $member->email }}<br/>{{ $member->phone }}</td>
          <td>{{ $member->designation }}</td>
          <td>
            @if($member->image != null)
            <img src="{{ asset('images/users/'.$member->image)}}" style="height: 40px; width: auto;" />
            @else
            <img src="{{ asset('images/user.png')}}" style="height: 40px; width: auto;" />
            @endif
          </td>
          <td>
            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteMemberModal{{ $member->id }}" data-backdrop="static" title="Delete Application" disabled=""><i class="fa fa-trash-o"></i></button>
            <!-- Delete Member Modal -->
            <!-- Delete Member Modal -->
            <div class="modal fade" id="deleteMemberModal{{ $member->id }}" role="dialog">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header modal-header-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Member</h4>
                  </div>
                  <div class="modal-body">
                    Confirm Delete the member of <b>{{ $member->name }}</b>
                  </div>
                  <div class="modal-footer">
                    {!! Form::model($member, ['route' => ['dashboard.deletemember', $member->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
            <!-- Delete Member Modal -->
            <!-- Delete Member Modal -->
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div>
    {{ $members->links() }}
  </div>    
@stop

@section('js')

@stop
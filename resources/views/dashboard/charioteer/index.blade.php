@extends('adminlte::page')

@section('title', 'Charioteer | Onesignal')

@section('css')

@stop

@section('content_header')
    <h1>
      Onesignal Push Notification Service
      <div class="pull-right">
        
      </div>
    </h1>
@stop

@section('content')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border text-blue">
          <i class="fa fa-fw fa-tree"></i>
          <h3 class="box-title">Questions</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addQuestionModel" data-backdrop="static" title="Add New Question" data-placement="top"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th width="">Question</th>
                  <th width="">Answer</th>
                  <th width="">Count</th>
                  <th width="">Status</th>
                  <th width="15%">Action</th>
                </tr>
              </thead>
              <tbody>
                @php $addmodalflag = 0; $editmodalflag = 0; @endphp
                @foreach($charioteers as $charioteer)
                <tr>
                  <td>{{ $charioteer->id }}</td>
                  <td>
                    {{ $charioteer->question }}
                  </td>
                  <td>
                    {{ $charioteer->answer }}
                  </td>
                  <td>
                    {{ $charioteer->count }}
                  </td>
                  <td>
                    @if($charioteer->status == 0)
                      <span class="badge">Pending</span>
                    @else
                      <span class="badge">Approved</span>
                    @endif
                  </td>
                  
                  <td>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editQuestionModel{{ $charioteer->id }}" data-backdrop="static" title="Edit Question" data-placement="top"><i class="fa fa-pencil"></i></button>
                    <!-- Edit Question Modal -->
                    <!-- Edit Question Modal -->
                    <div class="modal fade" id="editQuestionModel{{ $charioteer->id }}" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header modal-header-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Question</h4>
                          </div>
                          {!! Form::model($charioteer, ['route' => ['dashboard.onesignal.updateqa', $charioteer->id], 'method' => 'PUT', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                            <div class="modal-body">
                              <div class="form-group">
                                {!! Form::label('question', 'Question') !!}
                                {!! Form::text('question', null, array('class' => 'form-control', 'placeholder' => 'Write Question', 'required')) !!}
                              </div>
                              <div class="form-group">
                                {!! Form::label('answer', 'Answer') !!}
                                {!! Form::text('answer', null, array('class' => 'form-control', 'placeholder' => 'Write Answer', 'required')) !!}
                              </div>
                            </div>
                            <div class="modal-footer">
                              {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- Edit Question Modal -->
                    <!-- Edit Question Modal -->

                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteQuestionModal{{ $charioteer->id }}" data-backdrop="static" title="Delete"><i class="fa fa-trash-o"></i></button>
                    <!-- Delete Charioteer Modal -->
                    <!-- Delete Charioteer Modal -->
                    <div class="modal fade" id="deleteQuestionModal{{ $charioteer->id }}" role="dialog">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header modal-header-danger">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Question</h4>
                          </div>
                          <div class="modal-body">
                            Confirm Delete <b>{{ $charioteer->question }}</b>?
                          </div>
                          <div class="modal-footer">
                            {!! Form::model($charioteer, ['route' => ['dashboard.onesignal.delqa', $charioteer->id], 'method' => 'DELETE', 'class' => 'form-default', 'enctype' => 'multipart/form-data']) !!}
                                {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Delete Charioteer Modal -->
                    <!-- Delete Charioteer Modal -->
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          {{ $charioteers->links() }}
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-md-3">
      <div class="box box-success">
        <div class="box-header with-border text-green">
          <i class="fa fa-fw fa-tags"></i>
          <h3 class="box-title">Send Notification</h3>
          <div class="box-tools pull-right">
            {{-- <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addQuestionModel" data-backdrop="static" title="Add New Disaster Category" data-placement="top"><i class="fa fa-plus"></i></button> --}}
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {!! Form::open(['route' => 'dashboard.onesignal.sendpush', 'method' => 'GET', 'class' => 'form-default', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
            {{-- <div class="form-group">
              {!! Form::label('question', 'Question') !!}
              {!! Form::text('question', null, array('class' => 'form-control', 'placeholder' => 'Write Question', 'required')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('answer', 'Answer') !!}
              {!! Form::text('answer', null, array('class' => 'form-control', 'placeholder' => 'Write Answer', 'required')) !!}
            </div> --}}
            {!! Form::submit('Send a Random Push', array('class' => 'btn btn-primary btn-block')) !!}
          {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <!-- Add Question Modal -->
  <!-- Add Question Modal -->
  <div class="modal fade" id="addQuestionModel" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header modal-header-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Question</h4>
        </div>
        {!! Form::open(['route' => 'dashboard.onesignal.storeqa', 'method' => 'POST', 'class' => 'form-default', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
          <div class="modal-body">
            <div class="form-group">
              {!! Form::label('question', 'Question') !!}
              {!! Form::text('question', null, array('class' => 'form-control', 'placeholder' => 'Write Question', 'required')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('answer', 'Answer') !!}
              {!! Form::text('answer', null, array('class' => 'form-control', 'placeholder' => 'Write Answer', 'required')) !!}
            </div>
          </div>
          <div class="modal-footer">
            {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        {!! Form::close() !!}
        {{-- <form method="post" action="{{ route("dashboard.onesignal.postqstnapi") }}">
          <textarea class="form-control"></textarea>
          <button type="submit">Test</button>
        </form> --}}
      </div>
    </div>
  </div>
  <!-- Add Question Modal -->
  <!-- Add Question Modal -->
@stop

@section('js')

@stop
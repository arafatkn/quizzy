@extends('user.layouts.master')

@section('title', "Your Attempt on {$quiz->name}")

@section('content')

    <div class="card card-info">
        <div class="card-header">
            <h3 class="text-center">{{ $quiz->name }}</h3>
        </div>
        <div class="card-body p-0 m-0">
            <table class="table table-striped align-middle mb-0">
                <tbody>
                    <tr>
                        <th>Quiz Title</th>
                        <td>{{ $quiz->name }}</td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td><a href="?author_id={{ $quiz->author_id }}">{{ $quiz->author->name }}</a></td>
                    </tr>
                    <tr>
                        <th>Total Marks</th>
                        <td>{{ $quiz->total_marks }}</td>
                    </tr>
                    <tr>
                        <th>Total Questions</th>
                        <td>{{ $quiz->total_questions }}</td>
                    </tr>
                    <tr>
                        <th>Time Limit</th>
                        <td>{{ $quiz->time_limit_as_text }}</td>
                    </tr>
                    <tr>
                        <th>Attempted at</th>
                        <td>{{ $attempt->started_at->diffForHumans() }}</td>
                    </tr>
                    <tr>
                        <th>Your Points</th>
                        <td>{{ $attempt->points }}</td>
                    </tr>
                    <tr>
                        <th>Right Answered</th>
                        <td>{{ $attempt->corrects }}</td>
                    </tr>
                    <tr>
                        <th>Wrong Answered</th>
                        <td>{{ $attempt->wrongs }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Your Answers</h3>
        </div>
        <div class="card-body p-0">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <table class="table table-striped">
                        <tbody>
                        @foreach ($attempt->questions as $mcq)
                            <tr>
                                <th>{{ $loop->iteration }})</th>
                                <td>
                                    {{ $mcq->question }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row">
                                        @if ( isset($attempt->answers->{$mcq->id}) && $attempt->answers->{$mcq->id} !== null )
                                            @foreach ($mcq->options as $oid => $option)
                                                <div class="col-12 col-sm-6 d-grid gap-2">
                                                    @if ($attempt->answers->{$mcq->id} == $oid)
                                                        <button class="btn {{ $oid==$mcq->answer?"btn-success":"btn-danger" }} btn-sm mb-1 text-start">{{ $option }} &nbsp;{!! $oid==$mcq->answer?'<i class="bi bi-check-circle-fill text-end"></i>':'<i class="bi bi-x-circle-fill text-end"></i>' !!}</button>
                                                    @else
                                                        <button class="btn {{ $oid==$mcq->answer?"btn-success":"btn-info" }} btn-block btn-sm mb-1 text-start">{{ $option }}</button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach ($mcq->options as $oid => $option)
                                                <div class="col-12 col-sm-6 d-grid gap-2">
                                                    <button class="btn {{ $oid==$mcq->answer?"btn-success":"btn-info" }} btn-sm mb-1 text-start">{{ $option }}</button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            {{-- @break($loop->remaining <= $loop->iteration) --}}
                            @if( ($loop->count%2==0 && $loop->remaining==$loop->iteration) || ($loop->count%2==1 && $loop->remaining+1==$loop->iteration) )
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-sm-12">
                    <table class="table table-striped">
                        <tbody>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endsection

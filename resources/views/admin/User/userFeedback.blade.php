@extends('admin.layouts.main')

@section('myContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Feedback List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="my-4 d-flex justify-content-between">

                        <div class="">
                            <h2 class="title-3">Total Feedbacks - {{$feedbacks->total()}} </h2>
                        </div>


                        {{-- User Search --}}
                        <div class="">

                            <form class="form-header" action="" method="get">
                                <input class="au-input au-input--xl" type="text" value="{{ request('feedbackSearch') }}"
                                    name="feedbackSearch" placeholder="Search feedbacks ..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>

                            @if (session('removeSuccess'))
                                <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert">
                                    <p class="text-dark">  {{ session('removeSuccess') }} </p>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                        </div>


                    </div>

                    <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2 text-center" id="dataTable">

                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th></th>
                                    </tr>
                                    <tr class="spacer"></tr>
                                </thead>

                                <tbody>

                                    @foreach ($feedbacks as $feedback)
                                        <tr>
                                            <td>{{$feedback->id}}</td>
                                            <td>{{$feedback->user_id}}</td>
                                            <td>{{$feedback->name}}</td>
                                            <td>{{$feedback->email}}</td>
                                            <td>{{$feedback->message}}</td>
                                            <td><a href="{{route('admim#removeFeedback', $feedback->id)}}"><button class="btn btn-sm btn-danger">Remove</button></a></td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                        <!-- END DATA TABLE -->

                    <div class="mt-2">
                        {{ $feedbacks->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection


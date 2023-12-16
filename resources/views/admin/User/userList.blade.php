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
                                <h2 class="title-1">User List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="my-4 d-flex justify-content-between">

                        <div class="">
                            <h2 class="title-3">Total Users - {{$users->total()}} </h2>
                        </div>


                        {{-- User Search --}}
                        <div class="">

                            <form class="form-header" action="" method="get">
                                <input class="au-input au-input--xl" type="text" value="{{ request('userSearch') }}"
                                    name="userSearch" placeholder="Search users ..." />
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                    <tr class="spacer"></tr>
                                </thead>

                                <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->address}}</td>

                                            <td>
                                                <form action="{{route('admin#toAdmin',$user->id)}}" method="post">
                                                    @csrf
                                                    <div class="input-group">
                                                        <select name="role" class="form-select">
                                                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                                          </select>
                                                          <button type="submit" class="btn btn-sm btn-secondary">Save</button>
                                                      </div>
                                                </form>
                                            </td>

                                            <td><a href="{{route('admin#removeUser', $user->id)}}"><button class="btn btn btn-danger">Remove</button></a></td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                        <!-- END DATA TABLE -->

                    {{ $users->appends(request()->query())->links() }}

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection


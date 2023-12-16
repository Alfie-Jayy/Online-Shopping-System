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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="my-4 d-flex justify-content-between">

                        <div class="">
                            <h2 class="title-3">Total Admins - {{$admins->total()}} </h2>
                        </div>


                        {{-- Admin Search --}}
                        <div class="">
                            <form class="form-header" action="" method="get">
                                <input class="au-input au-input--xl" type="text" value="{{ request('adminSearch') }}"
                                    name="adminSearch" placeholder="Search for admins ..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>


                    </div>


                    @if (session('removeSuccess'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <p class="text-danger"> {{ session('removeSuccess') }} </p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                        <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2" id="dataTable">

                                <thead>
                                    <tr>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Gender</th>
                                        <th class="text-center">Role</th>
                                    </tr>
                                    <tr class="spacer"></tr>
                                </thead>

                                @foreach ($admins as $admin)
                                    <tbody>

                                        <tr class="tr-shadow">
                                                <td class="col-2 text-center">
                                                    @if (Auth::user()->id == $admin->id)
                                                            @if ($admin->image)
                                                               <img src="{{asset('storage/'.$admin->image)}}" alt="">
                                                            @else
                                                                @if ($admin->gender == 'male')
                                                                    <img src="{{asset('Image/male_profile.png')}}" alt="">
                                                                @else
                                                                    <img src="{{asset('Image/female_profile.jpg')}}" alt="">
                                                                @endif
                                                            @endif
                                                    @else
                                                        <a href="{{route('admin#changeRolePage',$admin->id)}}">
                                                            @if ($admin->image)
                                                            <img src="{{asset('storage/'.$admin->image)}}" alt="">
                                                        @else
                                                            @if ($admin->gender == 'male')
                                                                <img src="{{asset('Image/male_profile.png')}}" alt="">
                                                            @else
                                                                <img src="{{asset('Image/female_profile.jpg')}}" alt="">
                                                            @endif
                                                        @endif
                                                    </a>
                                                    @endif
                                                </td>
                                            <td class="text-center">{{$admin->name}}
                                                <input type="hidden" id="adminId" value={{$admin->id}}></td>
                                            <td class="text-center">{{$admin->email}}</td>
                                            <td class="text-center">{{$admin->gender}}</td>
                                            <td class="text-center">
                                                @if (Auth::user()->id == $admin->id)

                                                @else
                                                    <div class="">
                                                        <select id="changeRoleBtn" class="form-select">
                                                            <option value="admin">Admin</option>
                                                            <option value="user">User</option>
                                                        </select>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>

                                    </tbody>
                                @endforeach

                            </table>

                        </div>
                        <!-- END DATA TABLE -->

                    {{ $admins->appends(request()->query())->links() }}

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('JSscript')
    <script>
        $(document).ready(function(){
            $('#changeRoleBtn').change(function(){
                //view

                $parentNode = $(this).parents('body tr');

                $id = $parentNode.find('#adminId').val();
                $role = $('#changeRoleBtn').val();


                //server
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/admin/ajax/change/role',
                    data: { 'id': $id, 'role' : $role},
                    dataType: 'json',
                    success : function(response){
                        console.log(response);
                    }
                })
            })
        })
    </script>
@endsection

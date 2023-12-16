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

                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                    </div>

                    <div class="my-4 d-flex justify-content-between">

                        {{-- showing order counts --}}
                        <div class="">
                            @if (request('orderStatus') === null)
                                <h2 class="title-3">Total Orders - {{ count($orders) }}</h2>
                            @elseif (request('orderStatus') == 0)
                                <h2 class="title-3">Pending Orders - {{ count($orders) }}</h2>
                            @elseif (request('orderStatus') == 1)
                                <h2 class="title-3">Accepted Orders - {{ count($orders) }}</h2>
                            @elseif (request('orderStatus') == 2)
                                <h2 class="title-3">Rejected Orders - {{ count($orders) }}</h2>
                            @endif
                        </div>


                        <div class="">

                            <form action="{{route('admin#orderStatus')}}" method="get">
                                @csrf
                                <div class="input-group">
                                    <select name="orderStatus" class="form-select">
                                        <option value="">All</option>
                                        <option @if (request('orderStatus') == '0')
                                            selected
                                        @endif value="0">Pending</option>
                                        <option @if (request('orderStatus') == '1')
                                            selected
                                        @endif value="1">Accepted</option>
                                        <option @if (request('orderStatus') == '2')
                                            selected
                                        @endif value="2">Rejected</option>
                                      </select>
                                      <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-magnifying-glass me-2"></i>Filter</button>
                                  </div>
                            </form>
                        </div>

                    </div>


                    <div class="table-responsive table-responsive-data2">

                            <table class="table table-data2" >

                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Order Date</th>
                                        <th>Order Code</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                    <tr class="spacer"></tr>
                                </thead>

                                <tbody id="dataList">

                                    @foreach ( $orders as $order)


                                            <tr class="tr-shadow">
                                                <td>
                                                    {{$order->user_id}}
                                                    <input type="hidden" id="orderId" value= {{$order->id}}>
                                                </td>
                                                <td>{{$order->user_name}}</td>
                                                <td>{{$order->created_at->format('M d, Y')}}</td>
                                                <td> <a href="{{route('admin#orderDetail', $order->order_code)}}" class="text-decoration-none">{{$order->order_code}}</a> </td>
                                                <td>{{$order->total_price}} Kyats</td>
                                                <td>
                                                    <select class="form-select changeStatusBtn">
                                                        <option value="0" @if ($order->status == 0)
                                                            selected
                                                        @endif>Pending</option>
                                                        <option value="1" @if ($order->status == 1)
                                                            selected
                                                        @endif>Accept</option>
                                                        <option value="2" @if ($order->status == 2)
                                                            selected
                                                        @endif>Reject</option>
                                                    </select>
                                                </td>

                                            </tr>
                                            <tr class="spacer"></tr>

                                    @endforeach
                                </tbody>

                            </table>

                    </div>
                    <!-- END DATA TABLE -->

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('JSscript')
    <script>
        $(document).ready(function(){

            // $('#StatusBtn').change(function(){

            //     //view
            //     $status = $('#StatusBtn').val();

            //     // server
            //     $.ajax({
            //         type: 'get',
            //         url: 'http://127.0.0.1:8000/orders/status',
            //         data : {'status' : $status},
            //         dataType: 'json',
            //         success : function(response){

            //             $list = "";
            //             for($i = 0; $i< response.length; $i++){

            //                 $orderDate = new Date(response[$i].created_at);
            //                 $formattedDate = $orderDate.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });


            //                 if(response[$i].status  == 0){

            //                     $statusMsg = ` <select id="changeStatusBtn" class="form-select">
            //                                         <option value="0" selected >Pending</option>
            //                                         <option value="1">Accepted</option>
            //                                         <option value="2" >Rejected</option>
            //                                     </select>`;
            //                 }

            //                 else if(response[$i].status == 1){

            //                     $statusMsg = ` <select id="changeStatusBtn" class="form-select">
            //                                         <option value="0">Pending</option>
            //                                         <option value="1" selected >Accepted</option>
            //                                         <option value="2">Rejected</option>
            //                                     </select>`;
            //                 }

            //                 else if(response[$i].status == 2){
            //                     $statusMsg = ` <select id="changeStatusBtn" class="form-select">
            //                                         <option value="0">Pending</option>
            //                                         <option value="1">Accepted</option>
            //                                         <option value="2" selected>Rejected</option>
            //                                     </select>`;
            //                 }


            //                 $list += `


            //                         <tr class="tr-shadow">
            //                             <td>${response[$i].user_id} </td>
            //                             <td>${response[$i].user_name} </td>
            //                             <td>${$formattedDate}</td>
            //                             <td>${response[$i].order_code} </td>
            //                             <td>${response[$i].total_price}  Kyats</td>
            //                             <td>
            //                                 ${$statusMsg}
            //                             </td>

            //                         </tr>
            //                         <tr class="spacer"></tr>


            //                 `;

            //                 $('#dataList').html($list);
            //             }
            //         }
            //     })

            // })


            $('.changeStatusBtn').change(function(){

                //view
                $ParentNode = $(this).parents('tr');
                $orderId = $ParentNode.find('#orderId').val();
                $orderStatus = $(this).val();

                //server

                $data = {
                    'orderId' : $orderId,
                    'orderStatus' : $orderStatus
                }

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/admin/orders/change/status',
                    data: $data,
                    dataType: 'json',
                    success : function(response){
                        console.log(response);
                    }
                })

            })

        })
    </script>
@endsection

@extends('seller_layout')
@section('content')
<div class="has-sidebar-left page">
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="row row-eq-height my-3">
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="card no-b mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="icon-timer s-18"></i></div>
                            </div>
                            <div class="text-center">
                                <div class="s-48 my-3 font-weight-lighter">
                                {{$countOrders}}
                                </div>
                                Orders
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card no-b mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="icon-package s-18"></i></div>
                            </div>
                            <div class="text-center">
                                <div class="s-48 my-3 font-weight-lighter">{{$countProducts}}</div>
                                Products
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="card no-b mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="icon-call_received s-18"></i></div>
                            </div>
                            <div class="text-center">
                                <div class="s-48 my-3 font-weight-lighter">{{$countCoupons}}</div>
                                Coupon
                            </div>

                        </div>
                    </div>
                </div>
            </div>
                <div class="row">

                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-attach_money s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">${{$totalMoney}}</div>
                                    Doanh Thu
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-user-times s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">2</div>
                                    Deal Of Day (Comming Soon)
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-timer s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">68</div>
                                    Inbox(Comming Soon)
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-comment s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">{{$countComments}}</div>
                                    Comments
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-attach_money s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">${{$totalMoney}}</div>
                                    Doanh Thu
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-user-times s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">2</div>
                                    Deal Of Day (Comming Soon)
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-timer s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">68</div>
                                    Inbox(Comming Soon)
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-comment s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">{{$countComments}}</div>
                                    Comments
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
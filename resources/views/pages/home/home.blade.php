@extends('layout')
@section('content')
<div class="has-sidebar-left page">
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="row row-eq-height my-3">
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="card no-b mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="icon-timer s-18"></i></div>
                            </div>
                            <div class="text-center">
                                <div class="s-48 my-3 font-weight-lighter">{{$countOrders}}</div>
                                Orders
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card no-b mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="icon-user-circle-o s-18"></i></div>
                            </div>
                            <div class="text-center">
                                <div class="s-48 my-3 font-weight-lighter">{{$countUsers}}</div>
                                Users
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
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
                <div class="col-md-3 col-sm-6">
                    <div class="card no-b mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div><i class="icon-branding_watermark s-18"></i></div>
                            </div>
                            <div class="text-center">
                                <div class="s-48 my-3 font-weight-lighter">{{$countBrands}}</div>
                                Brand
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
                                    <div><i class="icon-clipboard-list2 s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">{{$countCategories}}</div>
                                    Categories
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-check-square-o s-18"></i></div>
                               </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">{{$countSubCategory}}</div>
                                    Sub Category
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-store_mall_directory s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">{{$countStores}}</div>
                                    Store
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
                                    <div><i class="icon-heart s-18"></i></div>
                                </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">{{$countFavorites}}</div>
                                    Favorite
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card no-b mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><i class="icon-star s-18"></i></div>
                               </div>
                                <div class="text-center">
                                    <div class="s-48 my-3 font-weight-lighter">{{$countCoupons}}</div>
                                    Coupon
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
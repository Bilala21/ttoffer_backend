@extends('layouts.front.app')
@section('head')
<title>Profile</title>
<style>
    .card_sec img {
        height: 215px;
        object-fit: cover;
    }

    .featured_sec img {
        height: 186px;
        width: 200px;
        object-fit: cover;
    }

    .star_img {
        height: 24px !important;
        width: auto !important;
    }
</style>
@endsection
@section('main')

<section class=" max-w-screen-xl mx-auto w-full py-10">
    <div class=" p-6  mx-auto  flex flex-col items-center space-y-4 mb-4">
        <div class="avatar">
            <div class="">
                <img src="@if(auth()->user()->img !== NULL) {{ asset(auth()->user()->img) }} @else {{ asset('images/icons/user.webp') }} @endif" style="height: 60px;" alt="Profile picture">
            </div>
        </div>
        <h5 class="text-xl font-medium leading-tight mb-2">{{ auth()->user()->name }}</h5>
        <div class="text-yellow-400 text-sm flex items-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EDEDED" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EDEDED" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EDEDED" class="bi bi-star-fill" viewBox="0 0 16 16">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
              </svg>
          <span class="ms-10 text-lg text-black"> 5.0</span> 
        </div>
        <div class="flex space-x-3 mb-4 text-sm font-medium">
            <div class="flex-auto flex space-x-3">
                <p>0 Follower</p>
                <p>0 Following</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-4 justify-center">
            <!-- Verification badges here -->
            <div class="grid grid-cols-4 gap-4">
                <div class="flex  flex-col justify-center items-center">
                    <div class="@if(auth()->user()->email_verified_at !== NULL) bg-[#00A87D] @else bg-red-600 @endif  w-10 h-10 rounded-full flex items-center justify-center"><img
                            src="images/icons/sms.png" alt=""></div>
                    <span class="text-xs font-medium text-center mt-3"> Email @if(auth()->user()->email_verified_at !== NULL) Verified @else Not Verified @endif </span>
                </div>
                <div class="flex  flex-col justify-center items-center">
                    <div class="@if(auth()->user()->image_verified_at !== NULL) bg-[#00A87D] @else bg-red-600 @endif w-10 h-10 rounded-full flex items-center justify-center"><img
                            src="images/icons/gallery.png" alt=""></div>
                    <span class="text-xs font-medium text-center mt-3"> Image @if(auth()->user()->image_verified_at !== NULL) Verified @else Not Verified @endif</span>
                </div>
                <div class="flex  flex-col justify-center items-center">
                    <div class="@if(auth()->user()->phone_verified_at !== NULL) bg-[#00A87D] @else bg-red-600 @endif w-10 h-10 rounded-full flex items-center justify-center"><img
                            src="images/icons/call-white.png" alt=""></div>
                    <span class="text-xs font-medium text-center mt-3"> Phone @if(auth()->user()->phone_verified_at !== NULL) Verified @else Not Verified @endif</span>
                </div>
                <div class="flex  flex-col justify-center items-center">
                    <div class="bg-[#00A87D] w-10 h-10 rounded-full flex items-center justify-center"><img
                            src="images/icons/verify.png" alt=""></div>
                    <span class="text-xs font-medium text-center mt-3"> Join TruYou</span>
                </div>

            </div>
        </div>
        <div class="inline-flex rounded-md shadow-sm mt-5">
            <a href="#" aria-current="page"
                class="px-8 py-2 text-xs font-normal text-white bg-primary border border-gray-300 rounded-s-full hover:bg-green-600 focus:z-10  focus:text-white ">
                Selling
            </a>
            <a href="#"
                class="px-8 py-2 text-xs font-normal text-gray-900 bg-[#EDEDED] border-t border-b border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10  focus:text-blue-700 ">
                Buying
            </a>
            <a href="#"
                class="px-8 py-2 text-xs font-normal text-gray-900 bg-[#EDEDED] border border-gray-300 rounded-e-full hover:bg-gray-100 hover:text-blue-700 focus:z-10  focus:text-blue-700 ">
                Archive
            </a>
        </div>

    </div>
    <div class="px-10 mb-3 flex md:hidden"><i class="bi bi-arrow-left-circle font-bold text-lg cursor-pointer menu_sidebar"></i></div>
    <div class="flex ">
        <!-- Sidebar starts -->
        <div class="bg-white px-10 md:p-5  space-y-6 w-full md:w-[30%] hidden md:block menu_side">
            <h3 class="font-bold text-lg text-[#1B2028]">Transactions</h3>
            <div class="space-y-2">
                <!-- Transactions -->
                <div class="bg-[#E1FFF7] text-[#1B2028] px-4 py-3 rounded-lg">
                    <a href="#" class="flex items-center space-x-2">
                        <img src="images/icons/receipt-item.png" alt=""> <span
                            class="text-sm font-normal ms-2">Purchases & Sales</span>
                    </a>
                </div>
                <div class=" text-[#1B2028] px-4 py-3 ">
                    <a href="#" class="flex items-center space-x-2">
                        <img src="images/icons/card-tick.png" alt=""> <span class="text-sm font-normal ms-2">Payment
                            &
                            Deposit method</span>
                    </a>
                </div>
                <hr class="my-10">

                <!-- Other Menu Items -->
                <!-- Save -->
                <h3 class="font-bold text-lg">Save</h3>
                <div class=" text-[#1B2028] px-4 py-3 ">
                    <a href="#" class="flex items-center space-x-2">
                        <img src="images/icons/heart.png" alt=""> <span class="text-sm font-normal ms-2">Saved
                            items</span>
                    </a>
                </div>
                <div class=" text-[#1B2028] px-4 py-3 ">
                    <a href="#" class="flex items-center space-x-2">
                        <img src="images/icons/notification-bing.png" alt=""> <span
                            class="text-sm font-normal ms-2">Search alerts</span>
                    </a>
                </div>
                <hr class="my-10">

                <!-- Other Menu Items -->
                <!-- Save -->
                <h3 class="font-bold text-lg">Account</h3>
                <div class=" text-[#1B2028] px-4 py-3 ">
                    <a href="#" class="flex items-center space-x-2">
                        <img src="images/icons/user-edit.png" alt=""> <span class="text-sm font-normal ms-2">Account
                            Setting</span>
                    </a>
                </div>
                <div class=" text-[#1B2028] px-4 py-3 ">
                    <a href="#" class="flex items-center space-x-2">
                        <img src="images/icons/arrow-up.png" alt=""> <span class="text-sm font-normal ms-2">Boost
                            Plus</span>
                    </a>
                </div>
                <div class=" text-[#1B2028] px-4 py-3 ">
                    <a href="#" class="flex items-center space-x-2">
                        <img src="images/icons/link.png" alt=""> <span class="text-sm font-normal ms-2">Custom
                            Profile
                            Link</span>
                    </a>
                </div>
                <hr class="my-10">
                <!-- Account -->

                <h3 class="font-bold text-lg">Account</h3>
                <div class=" text-[#1B2028] px-4 py-3 ">
                    <a href="#" class="flex items-center space-x-2">
                        <img src="images/icons/message-question.png" alt=""> <span
                            class="text-sm font-normal ms-2">Help
                            Center</span>
                    </a>
                </div>

            </div>
        </div>
        <!-- Sidebar ends -->

        <!-- Main content starts -->
        <div class=" px-10 md:w-1/2  border-s-2 border-0 border-gray-100 menu_full">

            <div class=" ">
                <!-- Replace with your items, this is just an example -->
                <div class="flex items-center justify-between">

                    <div class="flex ">
                        <div class=" me-5"> <img class="rounded" src="images/Rectangle 5683.png" alt="item image">
                        </div>
                        <div>
                            <h5 class="text-lg font-bold">Modern light clothes</h5>
                            <div class="flex">
                                <img class="z-50" src="images/Ellipse 2.png" alt="">
                                <img class="z-40 -translate-x-2" src="images/Ellipse3.png" alt="">
                                <img class="z-30 -translate-x-4" src="images/Ellipse4.png" alt="">
                                <img class="z-10 -translate-x-6" src="images/Ellipse5.png" alt="">
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-[#00A87D] text-xs">Sell Faster</span>
                                <a href="#" class="text-[#00A87D] text-xs ">Mark as sold</a>
                            </div>
                        </div>

                    </div>
                    <div>
                        <a href="" class="text-xs font-normal">21 View</a>
                    </div>

                </div>
                <hr class="my-6">
                <div class="flex items-center justify-between">

                    <div class="flex ">
                        <div class=" me-5"> <img class="rounded" src="images/Rectangle5684.png" alt="item image">
                        </div>
                        <div>
                            <h5 class="text-lg font-bold">Modern light clothes</h5>
                            <div class="flex">
                                <img class="z-50" src="images/Ellipse 2.png" alt="">
                                <img class="z-40 -translate-x-2" src="images/Ellipse3.png" alt="">
                                <img class="z-30 -translate-x-4" src="images/Ellipse4.png" alt="">
                                <img class="z-10 -translate-x-6" src="images/Ellipse5.png" alt="">
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-[#00A87D] text-xs">Sell Faster</span>
                                <a href="#" class="text-[#00A87D] text-xs ">Mark as sold</a>
                            </div>
                        </div>

                    </div>
                    <div>
                        <a href="" class="text-xs font-normal">21 View</a>
                    </div>

                </div>
                <hr class="my-6">
                <div class="flex items-center justify-between">

                    <div class="flex ">
                        <div class=" me-5"> <img class="rounded" src="images/Rectangle5685.png" alt="item image">
                        </div>
                        <div>
                            <h5 class="text-lg font-bold">Modern light clothes</h5>
                            <div class="flex">
                                <img class="z-50" src="images/Ellipse 2.png" alt="">
                                <img class="z-40 -translate-x-2" src="images/Ellipse3.png" alt="">
                                <img class="z-30 -translate-x-4" src="images/Ellipse4.png" alt="">
                                <img class="z-10 -translate-x-6" src="images/Ellipse5.png" alt="">
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-[#00A87D] text-xs">Sell Faster</span>
                                <a href="#" class="text-[#00A87D] text-xs ">Mark as sold</a>
                            </div>
                        </div>

                    </div>
                    <div>
                        <a href="" class="text-xs font-normal">21 View</a>
                    </div>

                </div>

                <hr class="my-6">
                <div class="flex items-center justify-between">

                    <div class="flex ">
                        <div class=" me-5"> <img class="rounded" src="images/Rectangle 5686.png" alt="item image">
                        </div>
                        <div>
                            <h5 class="text-lg font-bold">Modern light clothes</h5>
                            <div class="flex">
                                <img class="z-50" src="images/Ellipse 2.png" alt="">
                                <img class="z-40 -translate-x-2" src="images/Ellipse3.png" alt="">
                                <img class="z-30 -translate-x-4" src="images/Ellipse4.png" alt="">
                                <img class="z-10 -translate-x-6" src="images/Ellipse5.png" alt="">
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-[#00A87D] text-xs">Sell Faster</span>
                                <a href="#" class="text-[#00A87D] text-xs ">Mark as sold</a>
                            </div>
                        </div>

                    </div>
                    <div>
                        <a href="" class="text-xs font-normal">21 View</a>
                    </div>

                </div>
                <hr class="my-6">
                <div class="flex items-center justify-between">

                    <div class="flex ">
                        <div class=" me-5"> <img class="rounded" src="images/Rectangle 5687.png" alt="item image">
                        </div>
                        <div>
                            <h5 class="text-lg font-bold">Modern light clothes</h5>
                            <div class="flex">
                                <img class="z-50" src="images/Ellipse 2.png" alt="">
                                <img class="z-40 -translate-x-2" src="images/Ellipse3.png" alt="">
                                <img class="z-30 -translate-x-4" src="images/Ellipse4.png" alt="">
                                <img class="z-10 -translate-x-6" src="images/Ellipse5.png" alt="">
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-[#00A87D] text-xs">Sell Faster</span>
                                <a href="#" class="text-[#00A87D] text-xs ">Mark as sold</a>
                            </div>
                        </div>

                    </div>
                    <div>
                        <a href="" class="text-xs font-normal">21 View</a>
                    </div>

                </div>
                <hr class="my-6">
                <div class="flex items-center justify-between">

                    <div class="flex ">
                        <div class=" me-5"> <img class="rounded" src="images/Rectangle 5688.png" alt="item image">
                        </div>
                        <div>
                            <h5 class="text-lg font-bold">Modern light clothes</h5>
                            <div class="flex">
                                <img class="z-50" src="images/Ellipse 2.png" alt="">
                                <img class="z-40 -translate-x-2" src="images/Ellipse3.png" alt="">
                                <img class="z-30 -translate-x-4" src="images/Ellipse4.png" alt="">
                                <img class="z-10 -translate-x-6" src="images/Ellipse5.png" alt="">
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-[#00A87D] text-xs">Sell Faster</span>
                                <a href="#" class="text-[#00A87D] text-xs ">Mark as sold</a>
                            </div>
                        </div>

                    </div>
                    <div>
                        <a href="" class="text-xs font-normal">21 View</a>
                    </div>

                </div>
                <hr class="my-6">
                <div class="flex items-center justify-between">

                    <div class="flex ">
                        <div class=" me-5"> <img class="rounded" src="images/Rectangle 5683.png" alt="item image">
                        </div>
                        <div>
                            <h5 class="text-lg font-bold">Modern light clothes</h5>
                            <div class="flex">
                                <img class="z-50" src="images/Ellipse 2.png" alt="">
                                <img class="z-40 -translate-x-2" src="images/Ellipse3.png" alt="">
                                <img class="z-30 -translate-x-4" src="images/Ellipse4.png" alt="">
                                <img class="z-10 -translate-x-6" src="images/Ellipse5.png" alt="">
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-[#00A87D] text-xs">Sell Faster</span>
                                <a href="#" class="text-[#00A87D] text-xs ">Mark as sold</a>
                            </div>
                        </div>

                    </div>
                    <div>
                        <a href="" class="text-xs font-normal">21 View</a>
                    </div>

                </div>
                <!-- Repeat for each item -->
            </div>
        </div>
        <!-- Main content ends -->
    </div>


</section>


<script>
            $(document).on('click','.menu_sidebar',function(){
$(".menu_side").toggleClass('hidden block');
$(".menu_full").toggleClass('block hidden');
        });
</script>
@endsection
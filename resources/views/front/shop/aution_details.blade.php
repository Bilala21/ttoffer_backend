@extends('layouts.front.app')
@section('head')
<title>Auction Product Details</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<style>
.mySwiper2{
    height: 490px !important;
}

.custom_scroll::-webkit-scrollbar {
width: 0px;
}

.custom_scroll::-webkit-scrollbar-track {
box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

.custom_scroll::-webkit-scrollbar-thumb {
background-color: darkgrey;
outline: none;
}

.swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }



    .swiper {
        width: 100%;
        height: 300px;
        margin-left: auto;
        margin-right: auto;
    }
.slideContainer{
height: 450px;
}
.slideContainer .swiper-slide{
text-align: start;
}
.slideContainer .swiper-slide img {
        display: block;
        width: 100%;
        height: 160px;
        object-fit: cover;
    }
    .slideContainer .swiper-wrapper {
height: 330px;
    }
 .swiper-slide {
        background-size: cover;
        background-position: center;
    }

    .mySwiper2 {
        /* height: 80%; */
        width: 100%;
    }

    .mySwiper {
        height: 95px;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .mySwiper .swiper-slide {
        width: 25%;
        height: 95px;
        opacity: 0.4;
    }

    .mySwiper .swiper-slide-thumb-active {
        opacity: 1;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .btn-next {

        left: var(--swiper-navigation-sides-offset, 20px);
        right: auto;
    }

    .btn-prev,
    .btn-next {
        position: relative;
        width: 40px;
        height: 40px;
    }

    .btn-prev {
        left: -70px;
    }
    .btn-prev:after, .swiper-rtl .btn-next:after {
content: 'none';
}
.btn-next:after , .swiper-rtl .btn-prev:after  {
content: 'none';
display: none;
}
</style>
@endsection
@section('main')
<div class="max-w-screen-xl mx-auto mt-5 p-4 bg-white ">



    <div class="flex flex-col lg:flex-row justify-between py-4 w-full">
        <div class="md:w-[65%] h-fit">
            <div class="border-b-2 border-gray-200 pb-4">
                <h1 class="text-2xl font-semibold text-[#191F33]">Apple iPhone 7 Plus (32 GB) Hot price (Used)</h1>

                <div class="flex flex-wrap items-center py-2">
                    <span class="text-gray-600 flex items-center"> <img src="images/icons/MapPin.png" alt=""> <span
                            class="ms-2  text-sm font-normal text-[#767E94] "> 4517 New York. Manchester, Kentucky
                            394</span> </span>
                    <span class="text-gray-600 flex items-center mx-6"> <img src="images/icons/Clock.png" alt="">
                        <span class="ms-2  text-sm font-normal  text-[#767E94]"> 29 Jun 10:21 PM</span></span>
                    <span class="text-gray-600 flex items-center "> <img src="images/icons/Eye.png" alt=""> <span
                            class="ms-2  text-sm font-normal text-[#767E94]"> 69,656 Viewed</span> </span>
                </div>
            </div>
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="images/Image.png" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div thumbsSlider="" class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
                    </div>
                    <div class="swiper-slide">
                        <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                    </div>
                </div>
            </div>


            <div class="pt-10">
                <h3 class="text-xl font-semibold mb-3">Descriptions</h3>
                <p class="text-gray-700 text-sm font-normal">
                    Sed elementum pellentesque nibh, auctor varius felis ornare euismod. Etiam in purus ac ipsum
                    placerat imperdiet eu lacinia quam. Aliquam vel scelerisque quam. In suscipit massa non
                    elementum commodo. Nullam id mi pellentesque, tempus mauris quis, egestas arcu. In condimentum
                    mollis purus vitae egestas. Donec consectetur, felis et semper fermentum, eros orci egestas
                    mauris, at imperdiet justo erat vel quam. Aliquam at risus nec augue molestie consectetur eget
                    sit amet mauris. Mauris a lectus varius, dignissim nulla quis, commodo justo. Donec ornare
                    condimentum arcu sit amet feugiat. Interdum et malesuada fames ac ante ipsum primis in faucibus.
                    Donec venenatis mauris at sapien ultricies, sit amet pellentesque arcu imperdiet. Nulla
                    venenatis vel lectus interdum elementum. <br> <br>

                    Suspendisse cursus sodales placerat. Morbi eu lacinia ex. Curabitur blandit justo urna, id
                    porttitor est dignissim nec. Pellentesque scelerisque hendrerit posuere. Sed at dolor quis nisi
                    rutrum accumsan et sagittis massa. Aliquam aliquam accumsan lectus quis auctor. Curabitur rutrum
                    massa at volutpat placerat. Duis sagittis vehicula fermentum. Integer eu vulputate justo. Aenean
                    pretium odio vel tempor sodales. Suspendisse eu fringilla leo, non aliquet sem.
                </p>
            </div>



        </div>


        <div class="w-full lg:w-[35%] flex flex-col  mt-4 lg:mt-0 lg:p-10">


            <div class="flex  flex-col mt-5 md:mt-11">
                <!-- Seller information placeholder -->
                <div class="flex justify-between items-center">
<div class="flex items-center me-4 md:me-0"><img src="images/user.png" alt="Seller" class="w-12 h-12 rounded-full me-2" /><span class="font-semibold text-sm">Cameron Williamson</span></div>
<div class="flex items-center"><img src="images/icons/verified.png" class="h-5" alt=""> <a href="" class="font-semibold text-sm text-[#00A87D]">Verified Member</a></div>
                </div>

                <div class="flex justify-end text-end"><p class="text-sm">Member since August 2020</p></div>

                <div class="bg-gray-200 rounded-md flex justify-center md:justify-between items-center py-4 px-3 mt-4 md:mt-7">
                    <div class="">
<h3 class="font-medium text-lg">Starting price</h3>
<p>$5,000</p>

<div class="flex items-center mt-3">
<img class="z-50 h-7 w-7" src="images/Ellipse 2.png" alt="">
<img class="z-40 h-7 w-7 -translate-x-2" src="images/Ellipse3.png" alt="">
<img class="z-30 h-7 w-7 -translate-x-4" src="images/Ellipse4.png" alt="">
<a class="flex items-center justify-center w-7 h-7 px-2 py-1.5 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 -translate-x-5" href="#">+99</a>

<!-- <p class="-translate-x-4 text-xs w-full whitespace-nowrap">are live now</p> -->
</div>

                    </div>
                    <div class="border border-gray-400 h-full"></div>
                    <div>
                        <h3 class="font-medium text-lg">Current Bid Price</h3>
                        <p>$24,500</p>

                        <div class="mt-3">
                            <p>01: 23s remaining</p>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="flex flex-col mt-5 md:mt-11">
                <div class="flex items-center justify-between">
<div class="flex items-center">
<img src="images/icons/yellow-icon.png" class="me-2" alt="">
<h4 class="font-medium text-lg">Live Auction</h4>
</div>
<div class="flex items-center"><p>14 Bids Made</p></div>
                </div>

                <div class="mt-2 overflow-y-auto flex flex-col max-h-[300px] custom_scroll">
                    <ul role="list" class="divide-y divide-gray-100 pe-4">
                        <li class="flex justify-between gap-x-6 py-5">
                          <div class="flex min-w-0 gap-x-4">
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="min-w-0 flex-auto">
                              <p class="text-sm font-semibold leading-6 text-gray-900">Leslie Alexander</p>
                              <p class="mt-1 truncate text-xs leading-5 text-gray-500">leslie.alexander@example.com</p>
                            </div>
                          </div>
                          <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">Co-Founder / CEO</p>
                            <p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                          </div>
                        </li>
                        <li class="flex justify-between gap-x-6 py-5">
                          <div class="flex min-w-0 gap-x-4">
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="min-w-0 flex-auto">
                              <p class="text-sm font-semibold leading-6 text-gray-900">Michael Foster</p>
                              <p class="mt-1 truncate text-xs leading-5 text-gray-500">michael.foster@example.com</p>
                            </div>
                          </div>
                          <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">Co-Founder / CTO</p>
                            <p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                          </div>
                        </li>
                        <li class="flex justify-between gap-x-6 py-5">
                          <div class="flex min-w-0 gap-x-4">
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="min-w-0 flex-auto">
                              <p class="text-sm font-semibold leading-6 text-gray-900">Dries Vincent</p>
                              <p class="mt-1 truncate text-xs leading-5 text-gray-500">dries.vincent@example.com</p>
                            </div>
                          </div>
                          <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">Business Relations</p>
                            <div class="mt-1 flex items-center gap-x-1.5">
                              <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                              </div>
                              <p class="text-xs leading-5 text-gray-500">Online</p>
                            </div>
                          </div>
                        </li>
                        <li class="flex justify-between gap-x-6 py-5">
                          <div class="flex min-w-0 gap-x-4">
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="min-w-0 flex-auto">
                              <p class="text-sm font-semibold leading-6 text-gray-900">Lindsay Walton</p>
                              <p class="mt-1 truncate text-xs leading-5 text-gray-500">lindsay.walton@example.com</p>
                            </div>
                          </div>
                          <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">Front-end Developer</p>
                            <p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                          </div>
                        </li>
                        <li class="flex justify-between gap-x-6 py-5">
                          <div class="flex min-w-0 gap-x-4">
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="min-w-0 flex-auto">
                              <p class="text-sm font-semibold leading-6 text-gray-900">Courtney Henry</p>
                              <p class="mt-1 truncate text-xs leading-5 text-gray-500">courtney.henry@example.com</p>
                            </div>
                          </div>
                          <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">Designer</p>
                            <p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                          </div>
                        </li>
                        <li class="flex justify-between gap-x-6 py-5">
                          <div class="flex min-w-0 gap-x-4">
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="min-w-0 flex-auto">
                              <p class="text-sm font-semibold leading-6 text-gray-900">Tom Cook</p>
                              <p class="mt-1 truncate text-xs leading-5 text-gray-500">tom.cook@example.com</p>
                            </div>
                          </div>
                          <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm leading-6 text-gray-900">Director of Product</p>
                            <div class="mt-1 flex items-center gap-x-1.5">
                              <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                              </div>
                              <p class="text-xs leading-5 text-gray-500">Online</p>
                            </div>
                          </div>
                        </li>
                      </ul>
                      
                </div>
                
                <div class="mt-2">
                    <button class="bg-white text-black border border-gray-400 text-xs font-medium me-2 px-2.5 py-1 rounded-full cursor-pointer focus:bg-black focus:text-white">5K</button>
                    <button class="bg-white text-black border border-gray-400 text-xs font-medium me-2 px-2.5 py-1 rounded-full cursor-pointer focus:bg-black focus:text-white">15K</button>
                    <button class="bg-white text-black border border-gray-400 text-xs font-medium me-2 px-2.5 py-1 rounded-full cursor-pointer focus:bg-black focus:text-white">25K</button>
                    <button class="bg-white text-black border border-gray-400 text-xs font-medium me-2 px-2.5 py-1 rounded-full cursor-pointer focus:bg-black focus:text-white">35K</button>
                    <button class="bg-white text-black border border-gray-400 text-xs font-medium me-2 px-2.5 py-1 rounded-full cursor-pointer focus:bg-black focus:text-white">use custom bid</button>
                </div>

                <div class="mt-2 flex items-center " >
<div class="flex items-center me-3">
<div class="relative flex justify-center items-center">
  <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
   $
  </div>
  <input type="text" id="input-group-1" class="bg-white border border-gray-400 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-9 p-2.5  " placeholder="Price" value="100">
</div>
</div>
<div class="flex items-center">
<button type="button" data-modal-target="confirm-bid" data-modal-toggle="confirm-bid" class="text-gray-900 bg-white border border-gray-400 focus:outline-none hover:bg-gray-100 focus:ring-primary focus:border-primary font-medium rounded-lg text-sm px-5 py-2.5 "><img src="https://img.icons8.com/?size=50&id=7690&format=png" class="h-5" alt=""></button>
</div>
                </div>
            </div>
          
        </div>
    </div>
    <div class="py-10 ">
        <div class="flex items-center justify-between">
            <h3 class="font-semibold text-3xl">Related Ads</h3>
            <div class="flex items-center ">
                <div class="swiper-button-next btn-next border border-[#E0FFF7] rounded-full w-10 h-10 flex justify-center"> <img src="images/icons/ArrowRight (1).png" alt=""></div>
                <div class="swiper-button-prev btn-prev border border-[#E0FFF7] rounded-full w-10 h-10 flex justify-center"> <img src="images/icons/ArrowRight.png" alt=""></div>
            </div>
        </div>

        <div class="swiper slideContainer">

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-5 md:mt-10 card_sec swiper-wrapper">
                <div class="shadow-md rounded-lg swiper-slide">
                    <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                    <div class="px-3 py-2.5 rounded-b-lg w-full">
                        <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                        <h4 class="text-black font-bold mt-2">$212.99</h4>
                        <div class="flex flex-col justify-between  mt-1">
                            <div class="flex mt-2"> 
                                <p class="font-semibold text-sm">Time Left:</p>
                                <p class="text-[#00A87D] text-sm ms-3">1 Day 5 Hours</p>
                            </div>
                            <div class="mt-3 flex justify-center pb-5">
                                <button type="button"
                                    class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shadow-md rounded-lg swiper-slide">
                    <img src="images/card-2.png" class="rounded-t-lg w-full" alt="">
                    <div class="px-3 py-2.5 rounded-b-lg w-full">
                        <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                        <h4 class="text-black font-bold mt-2">$212.99</h4>
                        <div class="flex flex-col justify-between  mt-1">
                            <div class="flex mt-2"> 
                                <p class="font-semibold text-sm">Time Left:</p>
                                <p class="text-[#00A87D] text-sm ms-3">1 Day 5 Hours</p>
                            </div>
                            <div class="mt-3 flex justify-center pb-5">
                                <button type="button"
                                    class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shadow-md rounded-lg relative overflow-hidden swiper-slide">
                    <div
                        class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-110px]">
                        Urgents
                    </div>
                    <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                    <div class="px-3 py-2.5 rounded-b-lg w-full">
                        <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                        <h4 class="text-black font-bold mt-2">$212.99</h4>
                        <div class="flex flex-col justify-between  mt-1">
                            <div class="flex mt-2"> 
                                <p class="font-semibold text-sm">Time Left:</p>
                                <p class="text-[#00A87D] text-sm ms-3">1 Day 5 Hours</p>
                            </div>
                            <div class="mt-3 flex justify-center pb-5">
                                <button type="button"
                                    class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shadow-md rounded-lg relative overflow-hidden  swiper-slide">
                    <div
                        class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-110px]">
                        Urgents
                    </div>
                    <img src="images/card-4.png" class="rounded-t-lg w-full" alt="">
                    <div class="px-3 py-2.5 rounded-b-lg w-full">
                        <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                        <h4 class="text-black font-bold mt-2">$212.99</h4>
                        <div class="flex flex-col justify-between  mt-1">
                            <div class="flex mt-2"> 
                                <p class="font-semibold text-sm">Time Left:</p>
                                <p class="text-[#00A87D] text-sm ms-3">1 Day 5 Hours</p>
                            </div>
                            <div class="mt-3 flex justify-center pb-5">
                                <button type="button"
                                    class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shadow-md rounded-lg  swiper-slide">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="rounded-t-lg w-full" alt="">
                    <div class="px-3 py-2.5 rounded-b-lg w-full">
                        <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                        <h4 class="text-black font-bold mt-2">$212.99</h4>
                        <div class="flex flex-col justify-between  mt-1">
                            <div class="flex mt-2"> 
                                <p class="font-semibold text-sm">Time Left:</p>
                                <p class="text-[#00A87D] text-sm ms-3">1 Day 5 Hours</p>
                            </div>
                            <div class="mt-3 flex justify-center pb-5">
                                <button type="button"
                                    class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shadow-md rounded-lg  swiper-slide">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="rounded-t-lg w-full" alt="">
                    <div class="px-3 py-2.5 rounded-b-lg w-full">
                        <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                        <h4 class="text-black font-bold mt-2">$212.99</h4>
                        <div class="flex flex-col justify-between  mt-1">
                            <div class="flex mt-2"> 
                                <p class="font-semibold text-sm">Time Left:</p>
                                <p class="text-[#00A87D] text-sm ms-3">1 Day 5 Hours</p>
                            </div>
                            <div class="mt-3 flex justify-center pb-5">
                                <button type="button"
                                    class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>

  


</div>

{{-- Modals --}}
<div id="confirm-bid" tabindex="-1" data-modal-placement="top-center" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="hidden top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirm-bid">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h2 class="mb-4 text-xl md:text-2xl font-bold tracking-normal">Confirm Bid</h2>
                <h3 class="mb-5 text-lg font-normal text-gray-500 ">You have placed a bid for $26,000. <br> Should we place this as your Bid?</h3>
                <button data-modal-hide="confirm-bid" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 me-2">No, cancel</button>
                <button data-modal-hide="confirm-bid" type="button" class="text-white bg-primary hover:bg-primary/85 focus:ring-4 focus:outline-none focus:ring-primary/70  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, Place My Bid
                </button>
            </div>
        </div>
    </div>
</div>

<script>
     const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if ((maxVal - minVal) < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });

        
    var swiper = new Swiper(".mySwiper", {
  loop: true,
  spaceBetween: 10,
  slidesPerView: 6,
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
  loop: true,
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});

var swiper = new Swiper(".slideContainer" , {
  slidesPerView : 4,
  spaceBetween: 20,
  loop: true,
 grabSlide: "true",
 fade: "true",
  
pagination: {
  el: ".swiper-pagination",
  clickable:true,
},
navigation: {
  nextEl: ".swiper-button-next",
  prevEl: ".swiper-button-prev",
},
 breakpoints: {
  0:{
    slidesPerView: 1.
  },
  520: {
    slidesPerView: 2,
  },
  768: {
    slidesPerView: 3,
  },
  1000: {
    slidesPerView: 4,
  },
 }
});


</script>
@endsection
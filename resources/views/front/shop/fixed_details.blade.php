@extends('layouts.front.app')
@section('head')
<title>Fixed Product Details</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<style>
    .mySwiper2 {
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

    .slideContainer {
        height: 450px;
    }

    .slideContainer .swiper-slide {
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

    .btn-prev:after,
    .swiper-rtl .btn-next:after {
        content: 'none';
    }

    .btn-next:after,
    .swiper-rtl .btn-prev:after {
        content: 'none';
        display: none;
    }
</style>
@endsection
@section('main')
<div class="max-w-screen-xl mx-auto mt-5 p-4 bg-white ">



    <div class="flex flex-col lg:flex-row justify-between py-4 w-full">
        <div class="md:w-[68%] h-fit">
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


        <div class="w-full lg:w-[32%] flex flex-col  mt-4 lg:mt-0 lg:p-10">

            <div class=" flex items-center justify-between"><span class="text-2xl font-normal text-[#191F33]">$80,499
                </span>
                <div class=" w-10 h-10 bg-[#E1FFF7] flex items-center justify-center"><img src="images/icons/Heart1.png"
                        alt=""> </div>
            </div>
            <div class="my-10  flex flex-col justify-center ">
                <button type="button"
                    class="text-white bg-[#00A87D] hover:bg-[#00a87eda] focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">Send
                    Message</button>
                <button type="button" data-modal-target="make-offer" data-modal-toggle="make-offer"
                    class="mt-3 py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-[#EBEEF7] rounded-full border border-gray-200 hover:bg-gray-100 hover:text-black focus:z-10 focus:ring-4 focus:ring-gray-100 ">Make
                    Offer</button>
            </div>

            <div class="flex  flex-col">
                <!-- Seller information placeholder -->
                <div class="flex  justify-between">
                    <div class="flex items-center mr-4">
                        <img src="images/user.png" alt="Seller" class="w-12 h-12 rounded-full" />
                        <div class="ml-2">
                            <span class="text-xs font-normal mb-3">Add by:</span>
                            <div class="flex items-center"><span class="font-semibold text-sm">Kevin Gilbert</span>
                                <img src="images/icons/check-circle 1.png" alt="">
                            </div>

                        </div>
                    </div>

                    <a href="" class="font-semibold text-sm text-[#00A87D]"> View Profile</a>

                </div>
                <div class="text-sm text-gray-600 flex items-center font-normal mt-5">
                    <img src="images/icons/MapPinLine.png" alt=""><span class="ms-2"> 4517 New York. Manchester,
                        Kentucky 394</span>
                </div>

            </div>
            <hr class="my-10">
            <div class="flex flex-col mt-4">
                <div class="flex "> <span class="text-gray-600 me-10"> <span class="font-normal text-xs me-5">
                            Condition:</span> <span class="font-semibold text-xs "> Used</span> </span> <span
                        class="text-gray-600"> <span class="font-normal text-xs me-5"> Brand:</span> <span
                            class="font-semibold text-xs"> Samsung</span> </span>

                </div>
                <div class="flex "> <span class="text-gray-600">
                        <span class="text-gray-600 me-10"> <span class="font-normal text-xs me-5"> Model:</span>
                            <span class="font-semibold text-xs"> Galaxy M02</span>
                        </span> </span> <span class="text-gray-600"> <span class="font-normal text-xs me-5">
                            Edition:</span>
                        <span class="font-semibold text-xs"> 2/32</span>
                    </span>

                </div>
                <div>
                    <span class="text-gray-600"> <span class="font-normal text-xs me-5"> Authenticity:</span> <span
                            class="font-semibold text-xs"> Original</span>
                    </span>
                </div>


            </div>

            <!-- Location map placeholder -->
            <div class="w-full mt-4 md:mt-6 flex flex-col">
                <h3 class="text-lg font-bold tracking-wider">Location</h3>
                <div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52816169.558200695!2d-161.49265223136007!3d36.102185713814805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2s!4v1710194309678!5m2!1sen!2s"
                        style="border:0;" allowfullscreen="" loading="lazy" class="!rounded-lg"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="py-10 ">
        <div class="flex items-center justify-between">
            <h3 class="font-semibold text-3xl">Related Ads</h3>
            <div class="flex items-center ">
                <div
                    class="swiper-button-next btn-next border border-[#E0FFF7] rounded-full w-10 h-10 flex justify-center">
                    <img src="images/icons/ArrowRight (1).png" alt=""></div>
                <div
                    class="swiper-button-prev btn-prev border border-[#E0FFF7] rounded-full w-10 h-10 flex justify-center">
                    <img src="images/icons/ArrowRight.png" alt=""></div>
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
<div id="make-offer"  data-modal-backdrop="static" tabindex="-1" aria-hidden="true" data-modal-placement="top-center" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Make offer
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="make-offer">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="px-4 py-5 lg:px-9 lg:py-9 space-y-4 mx-auto">
<div class="max-w-sm flex flex-col justify-center items-center mx-auto">

<div class="flex flex-col justify-center items-center mb-3 lg:mb-16 w-full text-center ">
   <div class="flex">
    <div class="me-3"><img src="images/card-img.png" class="rounded-md w-[110px]" alt=""></div>
    <div class="flex items-start flex-col justify-center">
        <h3 class="text-lg font-medium tracking-normal">Modern light clothes</h3>
        <div class="flex items-center mt-3">
<div class="flex items-center me-2 space-x-1">
<svg class="w-5 h-5 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
    <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"/>
  </svg>
  <svg class="w-5 h-5 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
    <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"/>
  </svg>
  <svg class="w-5 h-5 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
    <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"/>
  </svg>
  <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-width="2" d="M11 5.1a1 1 0 0 1 2 0l1.7 4c.1.4.4.6.8.6l4.5.4a1 1 0 0 1 .5 1.7l-3.3 2.8a1 1 0 0 0-.3 1l1 4a1 1 0 0 1-1.5 1.2l-3.9-2.3a1 1 0 0 0-1 0l-4 2.3a1 1 0 0 1-1.4-1.1l1-4.1c.1-.4 0-.8-.3-1l-3.3-2.8a1 1 0 0 1 .5-1.7l4.5-.4c.4 0 .7-.2.8-.6l1.8-4Z"/>
  </svg>
  <svg class="w-5 h-5 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-width="2" d="M11 5.1a1 1 0 0 1 2 0l1.7 4c.1.4.4.6.8.6l4.5.4a1 1 0 0 1 .5 1.7l-3.3 2.8a1 1 0 0 0-.3 1l1 4a1 1 0 0 1-1.5 1.2l-3.9-2.3a1 1 0 0 0-1 0l-4 2.3a1 1 0 0 1-1.4-1.1l1-4.1c.1-.4 0-.8-.3-1l-3.3-2.8a1 1 0 0 1 .5-1.7l4.5-.4c.4 0 .7-.2.8-.6l1.8-4Z"/>
  </svg>
</div>
<div>5.0</div>
        </div>
    </div>
   </div>

<div class="mt-3 lg:mt-16">
<label for="input-group-1" class="block mb-2 text-sm font-medium text-gray-900 ">Enter Your Offer</label>
<div class="relative mb-6 flex justify-center items-center">
  <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
   $
  </div>
  <input type="text" id="input-group-1" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-9 p-2.5  " placeholder="Price">
</div>
</div>

</div>
<button type="button" class="text-white text-center bg-primary hover:bg-primary/85 focus:ring-4 border border-primary/70 focus:outline-none focus:ring-primary/55 font-medium rounded-full text-sm px-5 py-2.5 lg:py-3  inline-flex items-center justify-center me-2  w-full">
    Send Offer
    </button>
</div>
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

    var swiper = new Swiper(".slideContainer", {
        slidesPerView: 4,
        spaceBetween: 20,
        loop: true,
        grabSlide: "true",
        fade: "true",

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: {
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
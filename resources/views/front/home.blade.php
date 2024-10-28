@extends('layouts.front.app')
@section('head')
<title>Home</title>
<style>
    .card_sec img{
        height: 215px;
        object-fit: cover;
    }
    .featured_sec img{
        height: 186px;
        width: 200px;
        object-fit: cover;
    }
    .star_img{
        height: 24px !important;
        width: auto !important;
    }
</style>
@endsection
@section('main')
<!-- Hero section -->
@include('layouts.front.apps_section')
    
    <section class="mx-auto max-w-screen-xl">
    <div class="flex justify-center md:justify-between text-center">
    <div class="hidden md:flex">    <a href="#" class="text-[#292D32] text-base cursor-pointer hover:underline invisible">View All</a></div>
    <div>
        <h2 class="text-[#292D32] text-2xl md:text-3xl font-bold tracking-wide">Auction Products</h2>
        <p class="text-[#292D32] mt-1 text-lg">Hurry up! The auction is ending soon.</p>
    </div>
    <div class="hidden md:flex">
        <a href="#" class="text-[#292D32] text-base cursor-pointer hover:underline">View All</a>
    </div>
    </div>
    <div class="flex md:hidden justify-center mx-auto mt-3">
        <a href="" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-base  tracking-wider px-4 py-2 ">View All <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-5 md:mt-10 card_sec px-4">
    <div class="shadow-md rounded-b-lg">
        <img src="{{ asset('images/card-1.png') }}" class="rounded-t-lg w-full" alt="">
        <div class="px-3 py-2.5 rounded-b-lg">
            <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
            <h4 class="text-black font-bold">$212.99</h4>
            <div class="flex justify-between  mt-1">
    <div>
        <p class="font-semibold text-sm">Time Left:</p>
        <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
    </div>
    <div>
        <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
    </div>
            </div>
        </div>
    </div>
    
    <div class="shadow-md rounded-b-lg">
        <img src="{{ asset('images/card-2.png') }}" class="rounded-t-lg w-full" alt="">
        <div class="px-3 py-2.5 rounded-b-lg">
            <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
            <h4 class="text-black font-bold">$212.99</h4>
            <div class="flex justify-between  mt-1">
    <div>
        <p class="font-semibold text-sm">Time Left:</p>
        <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
    </div>
    <div>
        <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
    </div>
            </div>
        </div>
    </div>
    
    <div class="shadow-md rounded-b-lg relative overflow-hidden">
        <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-110px]">
    Urgents
        </div>
        <img src="{{ asset('images/card-3.png') }}" class="rounded-t-lg w-full" alt="">
        <div class="px-3 py-2.5 rounded-b-lg">
            <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
            <h4 class="text-black font-bold">$212.99</h4>
            <div class="flex justify-between  mt-1">
    <div>
        <p class="font-semibold text-sm">Time Left:</p>
        <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
    </div>
    <div>
        <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
    </div>
            </div>
        </div>
    </div>
    
    <div class="shadow-md rounded-b-lg relative overflow-hidden">
        <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-110px]">
    Urgents
        </div>
        <img src="{{ asset('images/card-4.png') }}" class="rounded-t-lg w-full" alt="">
        <div class="px-3 py-2.5 rounded-b-lg">
            <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
            <h4 class="text-black font-bold">$212.99</h4>
            <div class="flex justify-between  mt-1">
    <div>
        <p class="font-semibold text-sm">Time Left:</p>
        <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
    </div>
    <div>
        <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
    </div>
            </div>
        </div>
    </div>
    
    <div class="shadow-md rounded-b-lg">
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-t-lg w-full" alt="">
        <div class="px-3 py-2.5 rounded-b-lg">
            <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
            <h4 class="text-black font-bold">$212.99</h4>
            <div class="flex justify-between  mt-1">
    <div>
        <p class="font-semibold text-sm">Time Left:</p>
        <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
    </div>
    <div>
        <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
    </div>
            </div>
        </div>
    </div>
    
    <div class="shadow-md rounded-b-lg">
        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-t-lg w-full" alt="">
        <div class="px-3 py-2.5 rounded-b-lg">
            <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
            <h4 class="text-black font-bold">$212.99</h4>
            <div class="flex justify-between  mt-1">
    <div>
        <p class="font-semibold text-sm">Time Left:</p>
        <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
    </div>
    <div>
        <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
    </div>
            </div>
        </div>
    </div>
    
    <div class="shadow-md rounded-b-lg relative overflow-hidden">
        <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-110px]">
    Urgents
        </div>
        <img src="https://images.unsplash.com/photo-1501183638710-841dd1904471?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-t-lg w-full" alt="">
        <div class="px-3 py-2.5 rounded-b-lg">
            <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
            <h4 class="text-black font-bold">$212.99</h4>
            <div class="flex justify-between  mt-1">
    <div>
        <p class="font-semibold text-sm">Time Left:</p>
        <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
    </div>
    <div>
        <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
    </div>
            </div>
        </div>
    </div>
    
    <div class="shadow-md rounded-b-lg">
        <img src="https://images.unsplash.com/photo-1496440737103-cd596325d314?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-t-lg w-full" alt="">
        <div class="px-3 py-2.5 rounded-b-lg">
            <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
            <h4 class="text-black font-bold">$212.99</h4>
            <div class="flex justify-between  mt-1">
    <div>
        <p class="font-semibold text-sm">Time Left:</p>
        <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
    </div>
    <div>
        <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
    </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    
    
    <section class="mx-auto max-w-screen-xl mt-8 md:mt-10">
        <div class="flex justify-center md:justify-between text-center">
        <div class="hidden md:flex">    <a href="#" class="text-[#292D32] text-base cursor-pointer hover:underline invisible">View All</a></div>
        <div>
            <h2 class="text-[#292D32] text-2xl md:text-3xl font-bold tracking-wide">Feature Products</h2>
            <p class="text-[#292D32] mt-1 text-lg">Act fast! These featured products won't last long</p>
        </div>
        <div class="hidden md:flex">
            <a href="#" class="text-[#292D32] text-base cursor-pointer hover:underline">View All</a>
        </div>
        </div>
        <div class="flex md:hidden justify-center mx-auto mt-3">
            <a href="" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-md text-base  tracking-wider px-4 py-2 ">View All <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-10 featured_sec px-4">
    
            <div class="shadow-md rounded-lg relative overflow-hidden flex flex-col md:flex-row">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[22px] left-[-132px] md:top-[20.31px] md:left-[-275px] text-sm">
            Urgents
                </div>
                <img src="{{ asset('images/feature-pro-1.png') }}" class="rounded-t-lg md:rounded-l-lg !w-full md:w-full" alt="">
                <div class="px-6 py-4 md:py-8 rounded-b-lg flex flex-col items-start justify-between !w-full md:w-[60%]">
                    <p class="text-[#1B2028] cursor-pointer text-lg">Modern light clothes</p>
                    <div class="flex justify-between items-center w-full">
                        <div><h4 class="text-black font-bold text-base">$212.99</h4></div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/icons/star.png') }}" class="star_img" alt="">
                            <span class="text-[#636A80] ms-2">5.0</span> 
                        </div>
                    </div>
                    <div class="flex justify-between w-full  mt-1">
            <div>
                <div class="flex items-center text-[#636A80] font-medium text-base">
                    <i class="bi bi-geo-alt me-1 text-lg"></i><span class="text-[#636A80]">Belarus</span> 
                </div>
            </div>
            <div>
    
                <p class="focus:outline-none text-[#00A87D] font-medium rounded-[14px] text-base  tracking-wider">2 Weeks ago</p>
            </div>
                    </div>
                </div>
            </div>
    
            <div class="shadow-md rounded-lg relative overflow-hidden flex flex-col md:flex-row"> 
              
                <img src="{{ asset('images/feature-pro-2.png') }}" class="rounded-t-lg md:rounded-l-lg !w-full md:w-full" alt="">
                <div class="px-6 py-4 md:py-8 rounded-b-lg flex flex-col items-start justify-between !w-full md:w-[60%]">
                    <p class="text-[#1B2028] cursor-pointer text-lg">Modern light clothes</p>
                    <div class="flex justify-between items-center w-full">
                        <div><h4 class="text-black font-bold text-base">$212.99</h4></div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/icons/star.png') }}" class="star_img" alt="">
                            <span class="text-[#636A80] ms-2">5.0</span> 
                        </div>
                    </div>
                    <div class="flex justify-between w-full  mt-1">
            <div>
                <div class="flex items-center text-[#636A80] font-medium text-base">
                    <i class="bi bi-geo-alt me-1 text-lg"></i><span class="text-[#636A80]">Belarus</span> 
                </div>
            </div>
            <div>
    
                <p class="focus:outline-none text-[#00A87D] font-medium rounded-[14px] text-base  tracking-wider">2 Weeks ago</p>
            </div>
                    </div>
                </div>
            </div>
    
            <div class="shadow-md rounded-lg relative overflow-hidden flex flex-col md:flex-row">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[22px] left-[-132px] md:top-[20.31px] md:left-[-275px] text-sm">
            Urgents
                </div>
                <img src="{{ asset('images/feature-pro-3.png') }}" class="rounded-t-lg md:rounded-l-lg !w-full md:w-full" alt="">
                <div class="px-6 py-4 md:py-8 rounded-b-lg flex flex-col items-start justify-between !w-full md:w-[60%]">
                    <p class="text-[#1B2028] cursor-pointer text-lg">Modern light clothes</p>
                    <div class="flex justify-between items-center w-full">
                        <div><h4 class="text-black font-bold text-base">$212.99</h4></div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/icons/star.png') }}" class="star_img" alt="">
                            <span class="text-[#636A80] ms-2">5.0</span> 
                        </div>
                    </div>
                    <div class="flex justify-between w-full  mt-1">
            <div>
                <div class="flex items-center text-[#636A80] font-medium text-base">
                    <i class="bi bi-geo-alt me-1 text-lg"></i><span class="text-[#636A80]">Belarus</span> 
                </div>
            </div>
            <div>
    
                <p class="focus:outline-none text-[#00A87D] font-medium rounded-[14px] text-base  tracking-wider">2 Weeks ago</p>
            </div>
                    </div>
                </div>
            </div>
    
    
            <div class="shadow-md rounded-lg relative overflow-hidden flex flex-col md:flex-row">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[22px] left-[-132px] md:top-[20.31px] md:left-[-275px] text-sm">
            Urgents
                </div>
                <img src="{{ asset('images/feature-pro-4.png') }}" class="rounded-t-lg md:rounded-l-lg !w-full md:w-full" alt="">
                <div class="px-6 py-4 md:py-8 rounded-b-lg flex flex-col items-start justify-between !w-full md:w-[60%]">
                    <p class="text-[#1B2028] cursor-pointer text-lg">Modern light clothes</p>
                    <div class="flex justify-between items-center w-full">
                        <div><h4 class="text-black font-bold text-base">$212.99</h4></div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/icons/star.png') }}" class="star_img" alt="">
                            <span class="text-[#636A80] ms-2">5.0</span> 
                        </div>
                    </div>
                    <div class="flex justify-between w-full  mt-1">
            <div>
                <div class="flex items-center text-[#636A80] font-medium text-base">
                    <i class="bi bi-geo-alt me-1 text-lg"></i><span class="text-[#636A80]">Belarus</span> 
                </div>
            </div>
            <div>
    
                <p class="focus:outline-none text-[#00A87D] font-medium rounded-[14px] text-base  tracking-wider">2 Weeks ago</p>
            </div>
                    </div>
                </div>
            </div>
    
    
            <div class="shadow-md rounded-lg relative overflow-hidden flex flex-col md:flex-row">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[22px] left-[-132px] md:top-[20.31px] md:left-[-275px] text-sm">
            Urgents
                </div>
                <img src="{{ asset('images/feature-pro-2.png') }}" class="rounded-t-lg md:rounded-l-lg !w-full md:w-full" alt="">
                <div class="px-6 py-4 md:py-8 rounded-b-lg flex flex-col items-start justify-between !w-full md:w-[60%]">
                    <p class="text-[#1B2028] cursor-pointer text-lg">Modern light clothes</p>
                    <div class="flex justify-between items-center w-full">
                        <div><h4 class="text-black font-bold text-base">$212.99</h4></div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/icons/star.png') }}" class="star_img" alt="">
                            <span class="text-[#636A80] ms-2">5.0</span> 
                        </div>
                    </div>
                    <div class="flex justify-between w-full  mt-1">
            <div>
                <div class="flex items-center text-[#636A80] font-medium text-base">
                    <i class="bi bi-geo-alt me-1 text-lg"></i><span class="text-[#636A80]">Belarus</span> 
                </div>
            </div>
            <div>
    
                <p class="focus:outline-none text-[#00A87D] font-medium rounded-[14px] text-base  tracking-wider">2 Weeks ago</p>
            </div>
                    </div>
                </div>
            </div>
    
    
            <div class="shadow-md rounded-lg relative overflow-hidden flex flex-col md:flex-row">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[22px] left-[-132px] md:top-[20.31px] md:left-[-275px] text-sm">
            Urgents
                </div>
                <img src="{{ asset('images/feature-pro-1.png') }}" class="rounded-t-lg md:rounded-l-lg !w-full md:w-full" alt="">
                <div class="px-6 py-4 md:py-8 rounded-b-lg flex flex-col items-start justify-between !w-full md:w-[60%]">
                    <p class="text-[#1B2028] cursor-pointer text-lg">Modern light clothes</p>
                    <div class="flex justify-between items-center w-full">
                        <div><h4 class="text-black font-bold text-base">$212.99</h4></div>
                        <div class="flex items-center">
                            <img src="{{ asset('images/icons/star.png') }}" class="star_img" alt="">
                            <span class="text-[#636A80] ms-2">5.0</span> 
                        </div>
                    </div>
                    <div class="flex justify-between w-full  mt-1">
            <div>
                <div class="flex items-center text-[#636A80] font-medium text-base">
                    <i class="bi bi-geo-alt me-1 text-lg"></i><span class="text-[#636A80]">Belarus</span> 
                </div>
            </div>
            <div>
    
                <p class="focus:outline-none text-[#00A87D] font-medium rounded-[14px] text-base  tracking-wider">2 Weeks ago</p>
            </div>
                    </div>
                </div>
            </div>
    
    
            </div>
    </section>
@endsection
@extends('layouts.front.app')
@section('head')
<title>Shop Fixed</title>
<style>
    .card_sec img{
        height: 180px;
        width: 225px;
        object-fit: cover;
    }
    .star_img{
        height: 24px !important;
        width: auto !important;
    }

    .slider_in::-webkit-slider-thumb {
-webkit-appearance: none;
appearance: none;
width: 18px !important;
height: 18px !important;
background: #04AA6D !important;
cursor: pointer;
}

.slider_in::-moz-range-thumb {
width: 18px !important;
height: 18px !important;
background: #04AA6D !important;
cursor: pointer;
}

.slider{
height: 5px;
position: relative;
background: #ddd;
border-radius: 5px;
}
.slider .progress{
height: 100%;
left: 25%;
right: 25%;
position: absolute;
border-radius: 5px;
background: #00A87D;
}
.range-input{
position: relative;
}
.range-input input{
position: absolute;
width: 100%;
height: 5px;
top: -5px;
background: none;
pointer-events: none;
-webkit-appearance: none;
-moz-appearance: none;
}
input[type="range"]::-webkit-slider-thumb{
height: 17px;
width: 17px;
border-radius: 50%;
background: #00A87D;
pointer-events: auto;
-webkit-appearance: none;
box-shadow: 0 0 6px rgba(0,0,0,0.05);
}
input[type="range"]::-moz-range-thumb{
height: 17px;
width: 17px;
border: none;
border-radius: 50%;
background: #00A87D;
pointer-events: auto;
-moz-appearance: none;
box-shadow: 0 0 6px rgba(0,0,0,0.05);
}
</style>
@endsection
@section('main')
@include('layouts.front.apps_section')


<section class="mx-auto max-w-screen-xl px-4">
    <div class="flex justify-center md:justify-between text-center">
    <div class="">  
          <p class="text-lg text-black"><b>574,395</b> Results Founds</p>
        </div>
    <div class="">
        <div class="flex">
            
    <form class="w-[200px] mx-auto me-4">
        <label for="countries" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white hidden">Select an option</label>
        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="US">Latest</option>
          <option value="CA">Old</option>
        </select>
      </form>
    
      <form class="w-[200px] mx-auto">
        <label for="countries" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white hidden">Select an option</label>
        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="US">20 per page</option>
          <option value="CA">50 per page</option>
        </select>
      </form>
      
    
        </div>
    </div>
    </div>
    
    <div class="flex justify-between mt-5 md:mt-10">
        <div class="w-[21%] me-8">
    <div class="flex flex-col rounded-lg border border-gray-300 px-4 py-5">
    <div>
        <div class="flex justify-between items-center">
            <div><h1 class="uppercase font-bold">Seller Type</h1></div>
            <div><img src="https://img.icons8.com/?size=30&id=60653&format=png" class="h-[22px]" alt=""></div>
        </div>
        <div class="mt-3 md:mt-4">
            
    <div class="flex items-center mb-2">
        <input id="default-radio-1" type="radio" value="" name="default-radio" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary focus:ring-2 ">
        <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 ">Verified Seller</label>
    </div>
    <div class="flex items-center">
        <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary focus:ring-2 ">
        <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Urgent</label>
    </div>
    
        </div>
    </div>
    
    <div class="mt-5 border-t border-t-gray-300 pt-4">
        <div class="flex justify-between items-center">
            <div><h1 class="uppercase font-bold">Conditions</h1></div>
            <div><img src="https://img.icons8.com/?size=30&id=60653&format=png" class="h-[22px]" alt=""></div>
        </div>
        <div class="mt-3 md:mt-4">
            
    <div class="flex items-center mb-2">
        <input id="default-radio-1" type="radio" value="" name="default-radio" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary focus:ring-2 ">
        <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 ">Any</label>
    </div>
    <div class="flex items-center mb-2">
        <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary focus:ring-2 ">
        <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">New</label>
    </div>
    <div class="flex items-center">
        <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary focus:ring-2 ">
        <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Used</label>
    </div>
    
        </div>
    </div>
    
    <div class="mt-5 border-t border-t-gray-300 pt-4">
        <div class="flex justify-between items-center">
            <div><h1 class="uppercase font-bold">Top Location</h1></div>
            <div><img src="https://img.icons8.com/?size=30&id=60653&format=png" class="h-[22px]" alt=""></div>
        </div>
        <div class="mt-3 md:mt-4">     
    <form class="max-w-md mx-auto">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-primary dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="default-search" class="block w-full px-2 py-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary " placeholder="Cites, States and Country name" required />
        </div>
    </form>
        </div>
        <div class="mt-3 md:mt-4">
            
    <div class="flex items-center mb-2">
        <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary  focus:ring-2 ">
        <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900">America</label>
    </div>
    <div class="flex items-center mb-2">
        <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary  focus:ring-2 ">
        <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900">New York</label>
    </div>
    <div class="flex items-center mb-2">
        <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary  focus:ring-2 ">
        <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900">Belarus</label>
    </div>
    <div class="flex items-center mb-2">
        <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary  focus:ring-2 ">
        <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900">Islamabad</label>
    </div>
    <div class="flex items-center mb-2">
        <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary  focus:ring-2 ">
        <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900">larkana</label>
    </div>
    
        </div>
    </div>
    
    <div class="mt-5 border-t border-t-gray-300 pt-4">
        <div class="flex justify-between items-center">
            <div><h1 class="uppercase font-bold">Location Radius</h1></div>
            <div><img src="https://img.icons8.com/?size=30&id=60653&format=png" class="h-[22px]" alt=""></div>
        </div>
        <div class="mt-3 md:mt-4">
            
    
            <label for="default-range" class="block mb-2 text-sm font-medium text-primary">32 Miles</label>
            <input id="default-range" type="range" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider_in">
            
    
        </div>
    </div>
    
    <div class="mt-5 border-t border-t-gray-300 pt-4">
        <div class="flex justify-between items-center">
            <div><h1 class="uppercase font-bold">Prices</h1></div>
            <div><img src="https://img.icons8.com/?size=30&id=60653&format=png" class="h-[22px]" alt=""></div>
        </div>
        <div class="mt-3 md:mt-4">
            <div class="flex mb-3 price-input">
                <div class="relative me-1 field">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                  $
                    </div>
                    <input type="text" id="input-group-1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-8 p-2.5 input-min" placeholder="Min" value="2500">
                  </div>
    
                  <div class="relative field">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                  $
                    </div>
                    <input type="text" id="input-group-1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-8 p-2.5 input-max" placeholder="Max" value="7500">
                  </div>
            </div>
            <div class="slider">
                <div class="progress"></div>
              </div>
            <div class="range-input">
                <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
              </div>
        </div>
    </div>
    
    </div>
        </div>
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4  card_sec">
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
    
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
    
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
    
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
    
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
    
            <div class="shadow-md rounded-b-lg h-fit">
                <img src="images/card-1.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
            <div class="flex">
                <p class="font-semibold text-sm me-2">Time Left:</p>
                <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
            </div>
            <div class="mx-auto mt-2">
                <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
            </div>
                    </div>
                </div>
            </div>
              
            <div class="shadow-md rounded-b-lg relative overflow-hidden h-fit ">
                <div class="absolute bg-[#00A87D] uppercase text-white px-2 py-2 rotate-[320deg] w-full text-center top-[15.31px] left-[-83px] text-sm" >
            Urgents
                </div>
                <img src="images/card-3.png" class="rounded-t-lg w-full" alt="">
                <div class="px-3 py-2.5 rounded-b-lg">
                    <p class="text-[#1B2028] cursor-pointer">Modern light clothes</p>
                    <h4 class="text-black font-bold">$212.99</h4>
                    <div class="flex flex-col  mt-1">
                        <div class="flex">
                            <p class="font-semibold text-sm me-2">Time Left:</p>
                            <p class="text-[#00A87D] text-sm">1 Day 5 Hours</p>
                        </div>
                        <div class="mx-auto mt-2">
                            <button type="button" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-4 py-1 ">Bid Now</button>
                        </div>
                                </div>
                </div>
            </div>
            
    
            
            </div>
    </div>
    </section>
    

<script>
            const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider .progress");
let priceGap = 1000;

priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);

        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});
</script>
@endsection
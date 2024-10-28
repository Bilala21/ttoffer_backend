<nav class="bg-white border-gray-200 ">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-2.5 md:p-4 flex-col md:flex-row">
       <div class="flex items-center space-x-3 md:space-x-6">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="images/logo.png" class="h-10 md:h-11" alt="TTOffers Logo" />
        </a>
        
<div>
    <form class="max-w-lg mx-auto">
        <div class="flex border border-gray-300 rounded-xl py-2">
            <div class="relative w-full">
                <input type="text" id="search-dropdown" class="block px-2.5 py-1 w-full z-20 text-sm text-black placeholder:text-gray-900  rounded-s-xl focus:border-none focus:ring-0 focus:outline-none border-y-0 border-l-0 border-r border-r-gray-300" placeholder="Search" required />
              
            </div>
            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Your Email</label>
            <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center px-2 md:px-4 text-sm font-medium md:font-semibold md:tracking-wider text-center text-black  border-none me-2" type="button">For Sale <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
      </svg></button>
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <li>
                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mockups</button>
                </li>
                <li>
                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Templates</button>
                </li>
                <li>
                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Design</button>
                </li>
                <li>
                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Logos</button>
                </li>
                </ul>
            </div>
          <div class="relative w-14 z-20">
            <button type="submit" class="absolute top-0 end-0 px-2 py-1 mr-2 text-sm font-medium h-full text-white bg-[#00A87D] rounded-full border-none  focus:ring-0 focus:outline-none focus:ring-blue-300 ">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
          </div>
        </div>
    </form>
</div>
<div class="hidden md:flex items-center text-[#636A80] font-medium text-base">
    {{-- <i class="bi bi-geo-alt me-1 text-lg"></i> --}}
    <img src="images/icons/nav-location.png" class="me-1" style="height: 18px; width: 18px" alt="">
    <span class="text-primary">{{$location}}</span> 
</div>
       </div>
        <div class="flex items-center space-x-2 md:space-x-4 mt-3 md:mt-0">
            @auth
            <div class="flex md:hidden items-center flex-col text-[#636A80] font-medium text-sm md:text-base border-r border-r-gray-300 pe-2 md:pe-4">
                <img src="images/icons/nav-location.png" class="" style="height: 20px; width: 20px" alt="">
<span class="text-primary">{{$location}}</span>
            </div>

            <div class="flex items-center flex-col text-[#636A80] font-medium text-sm md:text-base border-r border-r-gray-300 pe-2 md:pe-4">
                <img src="images/icons/heart.png" alt="">
<span>Saved</span>
            </div>
            <div class="flex items-center flex-col text-[#636A80] font-medium text-sm md:text-base border-r border-r-gray-300 pe-2 md:pe-4">
                <img src="images/icons/messages.png" alt="">
<span>Chat</span>
            </div>
            <div class="flex items-center flex-col text-[#636A80] font-medium text-sm md:text-base border-r border-r-gray-300 pe-2 md:pe-4">
                <img src="images/icons/tag.png" alt="">
<span>Selling</span>
            </div>

            
            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="flex text-sm bg-gray-800 rounded-full md:me-0 " type="button">
                <span class="sr-only">Open user menu</span>
                <img class="w-full h-8 rounded-full" src="@if(auth()->user()->img !== NULL) {{ asset(auth()->user()->img) }} @else {{ asset('images/icons/user.webp') }} @endif " alt="user photo">
                </button>

     <!-- Dropdown menu -->
     <div id="dropdownAvatar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
          <div>{{ auth()->user()->username }}</div>
          <div class="font-medium truncate">{{ auth()->user()->email }}</div>
        </div>
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
          <li>
            <a href="{{route('profile.home')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Product</a>
          </li>
        </ul>
        <div class="py-2">
          <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Sign out</a>
        </div>
    </div>
            @else
            <button type="button"  data-modal-target="main-login" data-modal-toggle="main-login" class="login_modal_btn focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-3 py-1.5 md:px-4 md:py-2">Login</button>
            <button type="button"  data-modal-target="main-signup" data-modal-toggle="main-signup" class="focus:outline-none text-white bg-[#00A87D] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-[14px] text-base  tracking-wider px-3 py-1.5 md:px-4 md:py-2 ">Get Started</button> 
            @endauth

        </div>
    </div>
</nav>

<nav class="border-b border-b-gray-200 border-t border-t-gray-200">
    <div class="max-w-screen-xl px-10 md:px-4 py-3 mx-auto overflow-y-auto">
        <div class="flex items-center justify-start md:justify-center">
            <ul class="flex flex-row font-medium tracking-wider font_a mt-0 space-x-6 md:space-x-8 text-sm pr-5 md:pr-0">
                @foreach ($categories as $cat_limits)
                <li>
                    <a href="#" class="text-[#636A80]  hover:underline whitespace-nowrap">{{$cat_limits->name}}</a>
                </li>
                @endforeach
                <li>
                    <a href="#" data-modal-target="all-cats" data-modal-toggle="all-cats" class="text-[#636A80]  hover:underline whitespace-nowrap">More</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
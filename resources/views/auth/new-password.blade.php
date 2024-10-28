@extends('layouts.auth.app')
@section('head')
    <title>Set New Password</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('main')
<section>
    <div class="max-w-md mx-auto flex justify-center items-center flex-col h-screen">
       <a href="{{route('home')}}"> <h1 class="text-4xl md:text-5xl font-bold text-center mb-5 md:mb-9">{{env('APP_NAME')}}</h1></a>
        <div class="mx-auto bg-white shadow-xl rounded-xl px-5 py-8 md:px-10 w-full">
<div>
    <h3 class="text-xl md:text-2xl font-bold text-center mb-4  md:mb-8">Set New Password</h3>
</div>
<form class="space-y-6" id="data_form">
  <div id="toast-success" class="hidden items-center w-full p-4 mb-4 text-black bg-white rounded-lg shadow " role="alert" >
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ms-3 text-base font-medium tracking-wider success_text"></div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>
  <div id="toast-danger" class=" hidden items-center w-full p-4 mb-4 text-black bg-white rounded-lg shadow " role="alert">
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
        </svg>
        <span class="sr-only">Error icon</span>
    </div>
    <div class="ms-3 text-base font-medium tracking-wider error_text" ></div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>
    <div>
      <label for="email" class="block text-sm md:text-base font-medium text-gray-900">New Password</label>
      <div class="mt-2">
        <input id="email" placeholder="New Password..." name="pass" type="password"  required class="block w-full rounded-md border-2 border-gray-300 py-2.5 px-3  ring-0 focus:ring-0 text-gray-900 shadow-sm  placeholder:text-gray-500 text-sm  sm:text-base font-medium">
      </div>
    </div>

    <div>

    <div>
      <button type="submit" class=" action_btn flex w-full justify-center items-center rounded-md bg-primary px-3 py-3 text-base tracking-widest font-semibold leading-6 text-white shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Continue</button>

   
    </div>
  </form>
<div>
    
</div>
        </div>
    </div>
</section>

<script>
  $(function () {

    $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

// Actions
$(document).on('submit','#data_form', function(e){
e.preventDefault();
$(".action_btn").html('<svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/></svg>Loading');
$(".action_btn").attr('disabled',true);
$.ajax({
type:'POST',
url:"{{ url('new_password') }}",
data:$("#data_form").serialize(),
success:function(data){
$(".action_btn").html('Continue');
$(".action_btn").attr('disabled',false);
if (data.status==="error") {
$('#toast-success').removeClass('flex').addClass('hidden');
$('#toast-danger').removeClass('hidden opacity-0').addClass('flex');
$(".error_text").html(data.msg);
setTimeout(() => {
        window.location.href = data.url;
      }, 3000);
         } else {
          $('#data_form')[0].reset();
          $('#toast-danger').removeClass('flex').addClass('hidden');
          $('#toast-success').removeClass('hidden opacity-0').addClass('flex');
          $(".success_text").html(data.msg);
      setTimeout(() => {
        window.location.href = data.url;
      }, 3000);
       }},error:function() {
           $(".action_btn").html('Continue');
$(".action_btn").attr('disabled',false);
       }

});

});
})
</script>
@endsection

<!doctype html>
<html lang="ar" class="h-full bg-white" dir="rtl">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('home_page/images/salman-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('home_page/images/salman-32x32.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('home_page/auth/tailwind.css?id=a8c39236d4757146e4662ccaca3f4b19') }}" rel="stylesheet">

    <title>تطبيق تنور</title>
<style>
.center-div {
    display: flex;
    justify-content: center; /* centers horizontally */
    align-items: center;    /* centers vertically */
    padding-top: 5vh;          /* make sure the div has some height */
}
</style>
</head>
<body class="h-full">

{{--  <div class="bg-white py-24 sm:py-32">  --}}
  {{--  <div class="mx-auto max-w-7xl px-6 lg:px-8">  --}}
    <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
      <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
        <div class="relative">
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                <a href="{{ route('auth.teachers.login') }}" class="center-div">
                    <img class="rounded-t-lg" src="{{ asset('home_page/images/salman-180x180.png') }}" alt="" />
                </a>
                <div class="p-5">
                    <a href="{{ route('auth.teachers.login') }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                            المعلمين
                        </h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">
                        يمكنه من تسجيل ومتابعة الإنجاز اليومي للطلاب في داخل الحلقة التعليمية...
                    </p>
                    <a href="{{ route('auth.teachers.login') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-stone-700 rounded-lg hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-stone-300">
                        تسجيل الدخول كمعلم حلقة
                        <svg class="rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                <a href="{{ route('auth.users.login') }}" class="center-div">
                    <img class="rounded-t-lg" src="{{ asset('home_page/images/salman-180x180.png') }}" alt="" />
                </a>
                <div class="p-5">
                    <a href="{{ route('auth.users.login') }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                            المشرفين
                        </h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">
                        يمكنه من إدارة المدارس والحلقات والبيانات الخاصة بهم, بالإضافة لمتابعة المعلمين والطلاب..
                    </p>
                    <a href="{{ route('auth.users.login') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-stone-700 rounded-lg hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-stone-300">
                        تسجيل الدخول كمشرف
                        <svg class="rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
      </dl>
    </div>
  {{--  </div>  --}}
{{--  </div>  --}}

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"8acf520b39d0f154","version":"2024.7.0","r":1,"token":"07cafae28d384501922c21db72dafc16","serverTiming":{"name":{"cfL4":true}}}' crossorigin="anonymous"></script>
</body>
</html>

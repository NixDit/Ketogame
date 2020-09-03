{{-- HEADER --}}
@include('layouts.header')
{{-- NAVBAR --}}
@include('layouts.navbar')
{{-- YIELD FOR CONTENT --}}
@yield('content')
{{-- PAGE FOOT --}}
@include('layouts.page_foot')
{{-- FOOTER --}}
@include('layouts.footer')
{{-- SECTION TO ADD SPECIFIC JS TO BLADE.PHP --}}
@yield('scripts')
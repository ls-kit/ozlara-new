@extends('backend.layout.app')
@section('title','Role Management')
@section('content')
<p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>
@endsection

@push('custom_script')
    <script>
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>
@endpush

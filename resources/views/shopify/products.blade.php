
{{-- @dd($products); --}}
@extends('backend.layout.app')
@section('title','Role Management')
@section('content')
@push('custom_style')

<style>
    ul {
	display: flex;
	flex-flow: row wrap;
}
    ul li {
	flex-basis: 20%;
	list-style: none;
}
</style>

@endpush

<p>You are: {{ $shopDomain ?? Auth::user()->name }}</p>

Products page


<ul>
    <li>Image </li>
    <li>Title</li>
    <li>Ceated At</li>
    <li>Updated At</li>
</ul>

@foreach($products['products'] as $key => $product)
<ul>
    <li><img src="{{$product->image['src'] }}" height="80px" width="80px" /></li>
    <li>{{$product->title }}</li>
    <li>{{$product->created_at }}</li>
    <li>{{$product->updated_at }}</li>
</ul>
@endforeach

@endsection

@push('custom_script')
    <script>
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>
@endpush

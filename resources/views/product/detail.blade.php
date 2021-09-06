
@extends('layouts.common')

@section('css', '/asset/css/product/detail.css')
@section('title', '商品詳細頁')

@section('content')

<div id="detail">
  <p>ID：{{ $product->id }}</p>
  <p>標題：{{ $product->title }}</p>
  <p>敘述：{{ $product->description }}</p>
  <p>分類：{{ $product->category }}</p>
  <p>價格：{{ $product->price }}</p>
  <p>圖片：<img src="{{ $product->img }}" width="40" height="40"></p>
  <p>日期：{{ $product->date }}</p>
</div>

@endsection
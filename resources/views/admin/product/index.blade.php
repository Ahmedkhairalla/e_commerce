@extends('admin.mian')
@section('title','allProduct')
@section('body')

@if (session('success'))
<div class="alert alert-success" >{{ session('success') }}</div>


@endif
@if ($errors->any())
<div class="alert alert-danger" >
<ul>
@foreach ($errors->all() as $error )
<li>{{ $error }}</li>


@endforeach</ul></div>
@endif
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Desc</th>
        <th scope="col">image</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$product->name}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->description}}</td>
        <td><img src="{{asset("storage/$product->image")}}" width="100px" alt="" srcset=""></td>
        <td>
            <form action="{{url("deleteProduct/$product->id")}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">delete</button>
            </form>
            <h1>
                <a class="btn btn-success" href="{{url("editProduct/$product->id")}}" >edit</a>
            </h1>
            <h1>
                <a class="btn btn-success" href="{{url("ShowProduct/$product->id")}}" >show</a>
            </h1>
        </td>
    </tr>
    @endforeach

    </tbody>
  </table>

@endsection

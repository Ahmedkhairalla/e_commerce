<table>
<thead>

</thead>
<tbody>


    <div class="col-md-4">
      <div class="product-item">
        <a href="#"><img src="{{ asset("storage/$product->image") }}" alt=""></a>
        <div class="down-content">
          <a href="#"><h4>{{ $product->name }}</h4></a>
          <h6>LE{{ $product->price }}</h6>
          <p>{{ $product->description }}</p>
          
        </div>
      </div>
    </div>

</tbody>





<x-app-layout>

  <x-slider></x-slider>

    <div class="container">
     
        <div class="row">
          @foreach ($products as $item)
          <div class="col-lg-3  d-flex align-items-stretch">
            <div class="card h-100" style="width: 15rem;">
                <img src="{{ asset('images/' . $item->image) }}"    class="card-img-top " alt="{{$item->name}}">
                <div class="card-body d-flex flex-column "> 
                  <div class="d-flex justify-content-between">
                  <h5 class="card-title">{{$item->name}}</h5><h5 class="text-success">IDR {{$item->price}}</h5>
                </div> 
                  
                  <p class="card-text"><?php
                  
                  echo substr_replace($item->description, "...",150);

                  
      
                  ?></p>
                  <a href="{{route('food.show',$item->id)}}" class="btn btn-primary mt-auto align-self-start  ">Detail</a>
                </div>
              </div>
          </div>

          @endforeach

        </div>

        @if($products->count())
        <div class="row m-3 ">
            <div class="col d-flex justify-content-center">
            {{ $products->links() }}
            </div>
        </div>
        @endif
          
      </div>


    



     

</x-app-layout>

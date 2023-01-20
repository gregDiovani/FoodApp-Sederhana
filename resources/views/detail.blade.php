<x-app-layout>
    <div class="container">
        <div class="row bg-white">
            @foreach ($food as $item)
                
           
            <div class="col-4">
                <figure class="figure">
                    <img
                      src="{{ asset('images/' .$item->image) }}"
                      class="figure-img img-fluid rounded shadow-3 mb-3"
                      alt="{{$item->image}}"
                    />
                    <figcaption class="figure-caption">{{$item->description}}</figcaption>
                  </figure>
            </div>
            <div class="col-4 ">

                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h2 class="m-b-20">{{$item->name}}</h2>
                        <p class="m-b-0">{{$item->category->name}}</p>
                        <div class="d-flex">
                        <h1>Rp </h1><h1 id="price">{{$item->price}}</h1>
                        </div>

                    </div>
                </div>   
            </div>

            <div class="col-4">
                <div class="card my-3">
                <div class="d-flex">
                    <img src="{{ asset('images/'.$item->image) }}" class="card-img-top w-50" alt="Fissure in Sandstone"/>
                    <h5 class="align-self-center">{{$item->name}}</h5>
                </div>    
                    <div class="card-body">
                        <div class="col">

                        <div class="mb-3 d-flex align-items-center">
                            <label for="jumlah" class="form-label mx-2">Jumlah</label>
                            <input  name="jumlah"  type="number" min="1" value="1" style="width: 100px" class="form-control @error('description') is-invalid  @enderror" id="jumlahSub" ></input>
            
                            </div>

                      <h2 class="card-text" id="subtotal">Sub total {{$item->price}}</h2>
                            
                      <a href="#!" class="btn btn-success">+Keranjang</a>
                      <a href="#!" class="btn btn-success">Beli</a>
                    </div>
                  </div>

                          
            
            </div>
            @endforeach
          </div>
    </div>
</x-app-layout>
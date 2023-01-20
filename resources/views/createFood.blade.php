<x-app-layout>

  <div class="container bg-white p-3">
        <form action="{{route('food.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Makanan</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid  @enderror " id="exampleInputEmail1" aria-describedby="emailHelp">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
            @enderror
            </div>

            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Price</label>
                  <input type="number" name="price" class="form-control @error('price') is-invalid  @enderror " id="exampleInputEmail1" aria-describedby="emailHelp">
                  @error('price')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                  @enderror
                  </div>
              </div>
              
              <div class="col">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Categori</label>
                  <select name="category" class="form-select" aria-label="Default select example">
                      @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                  </select>
                  @error('category')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                  @enderror
                  </div>
              </div>
            </div>

           

            <div class="mb-3">
                <label for="formFile" class="form-label">Foto Makanan</label>
                <input name="image" onchange="showImage()" class="form-control @error('image') is-invalid  @enderror" id="image" type="file" id="image">
                
                <img src="..." id="frame" class="img-thumbnail" width="100px" height="100px" alt="...">
                
                @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
            @enderror
              </div>
            <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Description</label>
            <textarea  name="description" type="text" class="form-control @error('description') is-invalid  @enderror" id="exampleInputPassword1" rows="3"></textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
            @enderror
            </div>


          
           
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
      showImage()

function showImage(){

frame.src=URL.createObjectURL(event.target.files[0])

}

    </script>
</x-app-layout>
<x-app-layout>
  @if (session('success'))
  <div class="alert alert-success" style="margin-bottom: 13px;margin-left: 50px;margin-right: 50px;">
      <h3>{{ session('success') }}</h3>
  </div>
  @endif
<div class="container">
  <a  href="{{ route('food.create') }}"type="button" class="btn btn-outline-primary">{{ __('Create Food') }}</a>
    <table class="table align-middle mb-0 bg-white">
      @if(count($foods) > 0)
        <thead class="bg-light">
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          
          @foreach ($foods as $item)
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <img
                    src="{{ asset('images/'.$item->image) }}"
                    alt=""
                    style="width: 45px; height: 45px"
                    class="rounded-circle"  
                    />
                <div class="ms-3">
                  <p class="fw-bold mb-1">{{$item->namaMakanan}}</p>
                  <p class="text-muted mb-0">{{$item->kategori}}</p>
                </div>
              </div>
            </td>
            <td>
              <p class="fw-normal mb-1">{{$item->description}}</p>
            </td>
            <td>

              
                <a href="{{route('food.edit',$item->id)}}" type="button" class="btn btn-link btn-sm btn-rounded">
                    Edit
                  </a>
                  <a type="button" data-bs-toggle="modal" data-bs-target="#Modal{{$item->id}}" class="btn btn-link btn-sm btn-rounded">
                    Delete
                  </a>
            </td>
            
          </tr>


          <div class="modal fade" id="Modal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Aapakah Anda yakin ingin menghapus ?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <form action="{{route('food.destroy', $item->id) }}"  method="POST" >

                    @method('DELETE')

                    @csrf
                  <button type="submit"  class="btn btn-danger">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="alert alert-info my-4" role="alert">
            No Content Created
          </div>
          @endif

         
        </tbody>
      </table>
    
</div>



</x-app-layout>
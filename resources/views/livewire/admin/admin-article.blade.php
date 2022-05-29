<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container">

            <div>
              <h1 class="text-center">MAKALELER</h1>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  @if(session()->has('message'))
                    <div class="alert alert-success m-3">{{session('message')}}</div>
                  @endif
                  <div class="card-header">
                    <div class="row align-items-center">
                      <div class="col">
                        <h3 class="card-title">Tüm Makaleler</h3>
                      </div>
                      <div class="col-auto">
                        <button class="btn btn-outline-success" data-toggle="modal" data-target="#modal-default">Yeni Makale Ekle</button>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <input wire:model="title_search" type="text" class="form-control mt-3" placeholder="MAKALE BAŞLIĞI ARA">
                    </div>
                  </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Yazar id</th>
                          <th scope="col">Başlık</th>
                          <th scope="col">Makale</th>
                          <th scope="col">Fotoğraf</th>
                          <th scope="col">İşlemler</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($articles as $article)
                        <tr>
                          <td >{{ $loop->iteration }}</td>
                          <td>{{ $article->user_id }}</td>
                          <td>{{ $article->title }}</td>
                          <td >{{mb_strimwidth( $article->article , 0, 50, "...")}}</td>
                          <td>
                              @if($article->image )
                                <a href="{{ asset(\Illuminate\Support\Facades\Storage::url($article->image)) }}" target="_blank">
                                    <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($article->image)) }}" class="w-50 rounded-pill">
                                </a>
                              @endif
                          </td>
                          <td>
                            <a wire:click="getArticle({{$article->id}})" href="#" class="text-primary" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i></a>
                            ---
                            <a wire:click="getArticle2({{$article->id}})"  href="#" class="text-danger " data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      {{ $articles->links() }}
                  </div>
                </div>
              </div>
            </div>
           
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
      <!-- 1.modal -->
      <div wire:ignore.self class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
              <form wire:submit.prevent="newArticle">
                <div class="modal-header">
                  <h4 class="modal-title">Yeni Makale Ekle</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                      <label for="IpputUser_id" class="form-label">Kullanıcı id</label>
                      <input wire:model="user_id" type="int" class="form-control" id="IpputUser_id">
                      @error('user_id')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="IpputTitle" class="form-label">Başlık</label>
                      <input wire:model="title" type="text" class="form-control" id="IpputTitle">
                      @error('title')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="IpputArticle" class="form-label">Makale</label>
                      <textarea wire:model="article" class="form-control" id="IpputArticle"></textarea>
                      @error('article')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="IpputImage" class="form-label">Fotoğraf</label>
                      <input wire:model="image" type="file"class="form-control" id="IpputImage">
                      @error('image')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                    <button type="submit" class="btn btn-success">Makale Oluştur</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
       <!-- 2.modal -->
      <div wire:ignore.self class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
              <form wire:submit.prevent="updateArticle">
                <div class="modal-header">
                  <h4 class="modal-title">Makale Düzenle ({{$title}})</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                      <label for="IpputUser_id" class="form-label">Kullanıcı id</label>
                      <input wire:model="user_id" type="int" class="form-control" id="IpputUser_id">
                      @error('user_id')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="IpputTitle" class="form-label">Başlık</label>
                      <input wire:model="title" type="text" class="form-control" id="IpputTitle">
                      @error('title')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="IpputArticle" class="form-label">Makale</label>
                      <textarea wire:model="article" class="form-control" id="IpputArticle"></textarea>
                      @error('article')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="IpputImage" class="form-label">Fotoğraf</label>
                      <input wire:model="image" type="file"class="form-control" id="IpputImage">
                      @error('image')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                    <button type="submit" class="btn btn-success">Makale Güncelle</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- 3.modal -->
      <div wire:ignore.self class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <form wire:submit.prevent="destroy">
                <div class="modal-header">
                  <h4 class="modal-title text-center">MAKALE SİLME ({{$title}})</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h3 class="text-danger">Makale silinsin mi?</h3>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                  <button  type="submit" class="btn btn-danger">Makaleyi Sil</button>
                </div>
            </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      @section('foot')
        <script>
          window.livewire.on('add-user',()=>{
            $('#modal-default').modal('hide');
          });

          window.livewire.on('update-user',()=>{
            $('#modal-edit').modal('hide');
          });

          window.livewire.on('delete-user',()=>{
            $('#modal-delete').modal('hide');
          });
        </script>
      @endsection
  </div>
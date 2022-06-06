<div>
<!-- container -->
      <div class="container">
            <div>
              <h1 class="text-center">MAKALELERİM</h1>
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
                                    <h3 class="card-title">Tüm Makalelerim</h3>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-outline-success" data-toggle="modal" data-target="#modal-default">Yeni Makale Ekle</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Başlık</th>
                                        <th scope="col">Makale</th>
                                        <th scope="col">Fotoğraf</th>
                                        <th scope="col">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articles as $a)
                                    <tr>
                                    <td >{{ $loop->iteration }}</td>
                                    <td>{{ $a->title }}</td>
                                    <td >{!! $a->article  !!}</td> {{-- mb_strimwidth(, 0, 50, "...") --}}                                   
                                    <td>
                                        @if($a->image )
                                            <a href="{{ asset(\Illuminate\Support\Facades\Storage::url($a->image)) }}" target="_blank">
                                              <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($a->image)) }}" class="w-50 rounded-pill">
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a wire:click="getArticle({{$a->id}})" href="#" class="text-primary" data-toggle="modal" data-target="#modalEdit"><i class="fa fa-edit"></i></a>
                                        ---
                                        <a wire:click="getArticle2({{$a->id}})"  href="#" class="text-danger " data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
      <!-- 1.modal -->
      <div wire:ignore.self class="modal fade" id="modal-default" >
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
                      <label for="IpputTitle" class="form-label">Başlık</label>
                      <input wire:model.defer="title" type="text" class="form-control" id="IpputTitle">
                      @error('title')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="IpputArticle" class="form-label">Makale</label>
                      <div >
                        
                        <x-text-editor class="form-control" wire:model.lazy="article"/>
                        {{-- <textarea wire:model.defer="article" class="form-control" id="IpputArticle"></textarea> --}}
                      </div>
                      
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
      <div wire:ignore.self class="modal fade" id="modalEdit">
        <div class="modal-dialog">
          <div class="modal-content">
              <form wire:submit.prevent="updateArticle">
                <div class="modal-header">
                  <h4 class="modal-title">Makale Düzenle ({{$title}})</h4>
                  <button wire:click.prevent="clear()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                      <label for="IpputTitle" class="form-label">Başlık</label>
                      <input wire:model.defer="title" type="text" class="form-control" id="IpputTitle">
                      @error('title')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                        <x-text-editor class="form-control" wire:model.lazy="article"/>
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

      {{-- <script>
        $('#IpputArticle').summernote({
          placeholder: 'Makale Giriniz.',
          height: 100,
          toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
          ],
          callbacks: {
            onChange: function(contents, $editable) {
              @this.set('article', contents);
            }
          }
        });

          
      </script> 

      <script>
          $(function(){
            $('#IpputArticleUpdate').summernote({
              placeholder: 'Makale Giriniz.',
              height: 100,
              toolbar: [
                  ['style', ['style']],
                  ['font', ['bold', 'underline', 'clear']],
                  ['color', ['color']],
                  ['para', ['ul', 'ol', 'paragraph']],
                  ['table', ['table']],
                  ['insert', ['link', 'picture', 'video']],
                  ['view', ['fullscreen', 'codeview', 'help']]
              ],
              callbacks: {
                onChange: function(contents, $editable) {
                  @this.set('article', contents);
                }
              }
            });
          });
      </script> --}}

        <script>
          
          window.livewire.on('add-article',()=>{
            $('#modal-default').modal('hide');
          });

          window.livewire.on('update-article',()=>{
            $('#modalEdit').modal('hide');
          });

          window.livewire.on('delete-article',()=>{
            $('#modal-delete').modal('hide');
          });
        </script>
      @endsection
</div>
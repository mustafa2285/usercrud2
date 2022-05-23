<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  </head>
  <body>
    <div class="container">
        
        @auth
        <a type="submit"class="my-4 btn btn-light btn-sm w-100" href="{{route('users.index')}}"><h5>Anasayfa</h5></a>
        @else
        <a type="submit"class="mt-4 btn btn-light btn-sm w-100" href="{{route('login')}}"><h5>Giriş yap</h5></a>
        @endauth
        <div class="card">
         @foreach($users as $user)
            <div class="row py-3 mb-4 bg-secondary text-white rounded"  x-data="{ open{{ $loop->iteration }}: false }">
                <div class="col-11 ps-4 "><h4>{{ $user->name }} Kulanıcısına Ait Makaleler</h4> </div>
                <div class="col-1 ">
                    <div >
                        <a href ="#"   @click="open{{ $loop->iteration }} = true">
                            <i class="fas fa-caret-down" x-show="open{{ $loop->iteration }} == false"></i>
                            <i class="fas fa-caret-up" x-show="open{{ $loop->iteration }} == true"></i>
                        </a> 
                    </div>
                </div>               
                <!--  -->
                    <div @click.outside="open{{ $loop->iteration }} = false" x-show="open{{ $loop->iteration }}">
                        <table class="table table-success table-striped" >
                            <thead>
                                <tr>
                                    <th scope="col">Sıra</th>
                                    <th scope="col">Makale</th>
                                    {{-- <th scope="col">Kulanıcı Makale Başlıkları</th> --}}
                                </tr>
                            </thead>
                            @foreach($user->articles as $article)
                            <tbody>     
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> 
                                    <div class="row gl">
                                        <h5 class ="text-center"><strong>{{ $article->title }}</strong></h5>
                                        <div class="col-sm-4 ">
                                            @if($article->image)
                                                <a href="{{ asset(\Illuminate\Support\Facades\Storage::url($article->image)) }}" target="_blank">
                                                    <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($article->image)) }}" class="img-responsive">
                                                </a>
                                            @else                                           
                                                <img src="https://picsum.photos/id/2{{ $loop->iteration }}7/400/200" alt="">
                                            @endif                                           
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="mt-4">
                                                {{ $article->article }}
                                            </p>
                                        </div>
                                    </div>
                                    </td>
                                    
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>         
                </div>
            @endforeach
                    {{ $users->links() }}
            </div>
        </div>  
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </body>
</html>

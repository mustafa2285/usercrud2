<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anasayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  </head>
  <body>
<!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand  ms-5" href="#">@auth {{ auth()->user()->name }} @else Anasayfa @endauth</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_icerik" >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar_icerik">
                @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('users.article')}}">Makalelerim</a>
                    </li>
                    @if(auth()->user()->type == 'admin')
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('users.index')}}">Admin</a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav ms-auto me-5">
                    <li class="nav-item">
                        <a  href="{{route('userLogout')}}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"> Çıkış</i>
                        </a>
                    </li>
                </ul>
                @else
                <ul class="navbar-nav ms-auto me-5">
                    <li class="nav-item">
                        <a href="{{route('login')}}" class="nav-link">
                            <i class="nav-icon fas fa-sign-in-alt"> * Giriş *</i>
                        </a>
                    </li>
                </ul>
                @endauth
            </div>
        </nav>
        <!-- /.navbar -->
    <div class="container mt-4">
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
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </body>
</html>

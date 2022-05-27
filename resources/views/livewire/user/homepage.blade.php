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
                                    <h5 class ="text-center"><strong>{{ $article->title }}</strong></h5><br>
                                <div class="row">
                                    <div class="col-md-4 ">
                                        @if($article->image)
                                            <a href="{{ asset(\Illuminate\Support\Facades\Storage::url($article->image)) }}" target="_blank">
                                                <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($article->image)) }}" class="img-fluid">
                                            </a>
                                        @else                                           
                                            <img src="https://picsum.photos/id/2{{ $loop->iteration }}7/400/200" alt="">
                                        @endif                                           
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-7">
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
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand ml-5" href="{{route('welcome')}}">{{ auth()->user()->name }}</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_icerik" >
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbar_icerik">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="{{route('welcome')}}">Anasayfa</span></a>
			</li>
            @if(auth()->user()->type == 'admin')
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('users.index')}}">Admin</a>
                </li>
            @endif
		</ul>
		<ul class="navbar-nav ml-auto mr-5">
			<li class="nav-item">
        <a wire:click="userLogout" href="#" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"> Çıkış</i>
        </a>
      </li>
		</ul>
	</div>
</nav>
<!-- /.navbar -->
<div>
    <h1>neaber lea</h1>
</div>

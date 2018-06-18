<div class="row mainnavbarrow">
	<div id="navbar" class="navbar-collapse collapse">

		<ul class="nav navbar-nav mainna">
			<li {{ Request::path() == "home" ? 'class=nav-active' : '' }}>
				<a href="{{ route('home')}}" >Dashboard</a>
			</li>
			<li {{ Request::path() == "data/addrace" ? 'class=nav-active' : '' }}>
				<a href="{{ route('addrace')}}" >Race</a>
			</li>

			<li class="dropdown {{ Request::path() == 'data/addtrackdata' ? 'nav-active' : '' }}">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Data<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ route('addtrackdatamylaps')}}">MYLAPS</a></li>
					<li><a href="#">Hard Card</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>

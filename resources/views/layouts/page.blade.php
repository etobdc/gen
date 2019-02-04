@extends('layouts.app')

@section('body')
<body class="hold-transition skin-red sidebar-mini fixed">
	<div class="wrapper" id="app">
	<header class="main-header">
		<!-- Logo -->
		<a href="{{ route('dashboard.index') }}" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><img src="{{ $data['logos']['logo200'] }}" style="max-height: 50px; max-width: 200px"></span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							@if(strlen(Auth::user()->image) > 0)
							<img src="{{ asset('storage/users/'.Auth::user()->image) }}" class="user-image" alt="User Image">
							@else
							<span class="user-image bg-blue text-center text-bold">{{ substr(Auth::user()->name, 0, 2) }}</span>
							@endif
							<span class="hidden-xs">Bem-vindo, {{ Auth::user()->name }} <span class="caret"></span></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Sair
                                </a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			                        {{ csrf_field() }}
			                    </form>
							</li>
						</ul>
					</li>
				</ul>
			</div>

		</nav>
	</header>
	<!-- Menu lateral -->
	<aside class="main-sidebar">
		<section class="sidebar">
			<ul class="sidebar-menu" data-widget="tree">
				@foreach($data['modules'] as $module)
					@if($module->has_son == 0)
					<li class="{{ $data['request']->is($module->path) ? 'active' : '' || $data['request']->is($module->path . '/*') ? 'active' : ''  }}">
						<a href="{{ route($module->route . '.index') }}">
							<i class="{{ $module->icon }}"></i> <span>{{ $module->name }}</span>
						</a>
					</li>
					@else
					<li class="treeview {{ $data['request']->is($module->path . '/*') ? 'active menu-open' : '' }}">
						<a href="#">
							<i class="{{ $module->icon }}"></i> <span>{{ $module->name }}</span>

							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu"
							style="{{ $data['request']->is($module->path) ? 'display:block;' : '' }}">
							@foreach($module->submodules AS $submodule)
							<li
								class="{{ $data['request']->is($submodule->father_path . "/" . $submodule->path . "*") ? 'active' : '' }}">
								<a href="{{ route($submodule->route . '.index') }}">
									<i class="fa fa-circle-o"></i> {{ $submodule->name }}
								</a>
							</li>
							@endforeach
						</ul>
					</li>
					@endif
				@endforeach
			</ul>
		</section>
	</aside>
	<!-- /.Menu lateral -->

	<div class="content-wrapper">

		<content-header v-bind:headers="{{$headers}}"></content-header>

		<section class="content">
			@yield('content')
		</section>
	</div>

	<footer class="main-footer">
		<strong>Copyright &copy; {{ date('Y') }} NatSystem</strong> Todos os direitos reservados.
	</footer>
</div>

</body>
@endsection

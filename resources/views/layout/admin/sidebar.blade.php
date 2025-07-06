	<nav id="sidebar"  >
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
					  <i class="fa fa-bars"></i>
					  <span class="sr-only">Toggle Menu</span>
					</button>
				</div >
					<h1 class="text-center  my-3"><a href="{{ route('admin.dashboard') }}" class="text-white ">Hi ,Admin</a></h1>
				<ul class="list-unstyled components mb-5 ">
			
				<li class="{{ request()->routeIs('admin.menus') ? 'bg-success' : '' }}">
                   <a class="" href="{{ route('admin.menus') }}">
                         <span class="fa fa-bars mr-3"></span> Menus
                   </a>
                 </li>
				 	<li class="{{ request()->routeIs('admin.banner') ? 'bg-success' : '' }}">
                   <a class="" href="{{ route('admin.banner') }}">
                         <span class="fa fa-picture-o mr-3"></span> Banner
                   </a>
                 </li>
				 <li class="{{ request()->routeIs('admin.category') ? 'bg-success' : '' }}">
                   <a class="" href="{{ route('admin.category') }}">
                         <span class="fa fa-list-alt mr-3"></span> Categories
                   </a>
                 </li>
				  <li class="{{ request()->routeIs('admin.variation') ? 'bg-success' : '' }}">
                   <a class="" href="{{ route('admin.variation') }}">
                         <span class="fa fa-list-alt mr-3"></span> Variations
                   </a>
                 </li>
				</ul>
			</nav>
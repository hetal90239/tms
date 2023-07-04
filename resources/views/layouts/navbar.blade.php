
@isset($mytype)
  {{admin}}
@endisset
$mytype = $mytype ?? 
 @if($mytype==="admin")
     <!-- Sidebar Menu -->
     <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ url('/emp') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Employee Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/task') }}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Task Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/report') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Complete Task</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/status') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Status Report</p>
                </a>
              </li>
            </ul>
          </li>
      </nav>
     @else
      <!-- Sidebar Menu -->
     <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ url('/pending') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p> Pending Task </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/complete') }}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Complete Task</p>
            </a>
          </li>
          </li>
      </nav>
     @endif
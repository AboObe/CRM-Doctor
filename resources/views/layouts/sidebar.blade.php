<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.premiumaligners.net/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/premium_white.ico" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">PREMIUM <sub>CRM</sub></span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/dashboard.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">CRM</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('doctor.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-md" style="font-size: 20px;"></i>
            </div>
            <span class="nav-link-text ms-1" >Doctors</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('appointment.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-calendar-check" style="font-size: 20px;"></i>
            </div>
            <span class="nav-link-text ms-1" >Appointments</span>
          </a>
        </li>



        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">USERS</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('admin') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-users-cog" style="font-size: 20px;"></i>
            </div>
            <span class="nav-link-text ms-1" >Admins</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('representative') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-tie" style="font-size: 20px;"></i>
            </div>
            <span class="nav-link-text ms-1" >Representatives</span>
          </a>
        </li>

        <a class="nav-link text-white " href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-sign-out-alt" style="font-size: 20px"></i>
            </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            
            <span class="nav-link-text ms-1">Sign Out</span>
          </a>


<!--
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Reports</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/sign-up.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10" >assignment</i>
            </div>
            <span class="nav-link-text ms-1">Report</span>
          </a>
        </li>
-->
      </ul>
    </div>
  </aside>
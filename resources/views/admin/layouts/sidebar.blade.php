<nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{url ('admin/dashboard')}}">
                <img src="https://rams.apc.edu.ph/logo/mini-logo.png" width="150px"> 
                </a>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{url('admin/dashboard')}}">
						<i class="align-middle" data-feather="sliders"></i> 
                            <span class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- navitem collape -->
                    <li class="sidebar-item">
                        <a class="sidebar-link" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="align-middle" data-feather="table"></i>
                            <span class="align-middle">Manage Venues</span>
                        </a>
                        <div class="collapse " id="collapseExample">
                            <ul class="sidebar-nav">
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{url('admin/venue/')}}">
                                        <span class="align-middle">Venue</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{url('admin/venueType')}}">
                                        <span class="align-middle">Venue Types</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- navitem collapse end -->
            
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{url('admin/reservation')}}">
						<i class="align-middle" data-feather="book"></i> 
                            <span class="align-middle">Reservations</span>
                        </a>
                    </li>

                    <!-- MESSAGES SECTION -->
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{url('chatify')}}">
                        <i class="align-middle" data-feather="message-square"></i>   
                            <span class="align-middle">Messages</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav> 
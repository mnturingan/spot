<nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{url ('admin/dashboard')}}">
                <img src="https://rams.apc.edu.ph/logo/mini-logo.png" width="150px">
                </a>
                <ul class="sidebar-nav">

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{url('/browse')}}">
						<i class="align-middle" data-feather="book"></i> 
                            <span class="align-middle">Browse Venues</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{url('reservation/create')}}">
						<i class="align-middle" data-feather="book"></i> 
                            <span class="align-middle">Reserve</span>
                        </a>
                    </li>
            
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('reservation.my-reservations') }}">
						<i class="align-middle" data-feather="book"></i> 
                            <span class="align-middle">My Reservations</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-sign-up.html">
                        <i class="align-middle" data-feather="message-square"></i>   
                            <span class="align-middle">Messages</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav> 

 

        <li class="c-sidebar-nav-item">
            <img style="height: 100px; width: 100px; border-radius: 50%; margin-left: 70px; margin-top: 10px" src="{{ url('/images/profile.png') }}" alt="">
        </li>
        <li class="c-sidebar-nav-title">{!! Auth::user()->name !!}</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href=""><i></i>
                Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="cil-energy"></i> Documents
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#"> Manage Documents</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#"> Document Location</a></li>
            </ul>
        </li>
        <li class="c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="cil-energy"></i> Permit
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('/applicant') }}"> Applicants</a></li>   
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('permit/transaction') }}"> Transactions</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('/map') }}"> Map</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url('/payment') }}"> Payment</a></li>
            </ul>
        </li>
        
        

  
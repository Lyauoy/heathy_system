<div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
        @php $user = auth()->user(); @endphp
        <ul>
            <li class="menu-title">Main</li>
            
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>

            @if($user->isAdmin() || $user->isEmployee())
                <li class="{{ request()->routeIs('doctors.*') ? 'active' : '' }}">
                    <a href="{{ route('doctors.index') }}"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                </li>
            @endif

            <li class="{{ request()->routeIs('patients.*') ? 'active' : '' }}">
                <a href="{{ route('patients.index') }}"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
            </li>

            <li class="{{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                <a href="{{ route('appointments.index') }}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
            </li>

            <li class="{{ request()->routeIs('schedules.*') ? 'active' : '' }}">
                <a href="{{ route('schedules.index') }}"><i class="fa fa-calendar-check-o"></i> <span>Doctor Schedule</span></a>
            </li>

            @if($user->isAdmin())
                <li class="submenu">
                    <a href="#"><i class="fa fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                            <a href="{{ route('employees.index') }}">Employees List</a>
                        </li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fa fa-money"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="{{ request()->routeIs('accounts.invoices') ? 'active' : '' }}">
                            <a href="{{ route('accounts.invoices') }}">Invoices</a>
                        </li>
                        <li class="{{ request()->routeIs('accounts.payments') ? 'active' : '' }}">
                            <a href="{{ route('accounts.payments') }}">Payments</a>
                        </li>
                        <li class="{{ request()->routeIs('accounts.expenses') ? 'active' : '' }}">
                            <a href="{{ route('accounts.expenses') }}">Expenses</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->routeIs('departments.*') ? 'active' : '' }}">
                    <a href="{{ route('departments.index') }}"><i class="fa fa-hospital-o"></i> <span>Departments</span></a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a>
                </li>
            @endif
        </ul>
    </div>
</div>

<x-app-layout>
    <x-slot name="header">
        <h3>{{ __('Dashboard') }}</h3>
        <h5>
            @if(Auth::user()->role == 'Doctor')
                <p>Welcome Dr. {{ Auth::user()->name }}</p>
            @elseif(Auth::user()->role == 'Patient')
                <p>Welcome {{ Auth::user()->name }}</p>
            @elseif(Auth::user()->role == 'Admin')
                <p>Welcome Admin {{ Auth::user()->name }}</p>
            @endif
        </h5>
    </x-slot>
    <?php
        session_start();
        $_SESSION["userID"] = Auth::user()->id;
    ?>
        <div class="row" style="margin: 0 auto;">
            @if(Auth::user()->role == 'Admin')
            <div class="card text-white bg-info mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Patients</div>
                <div class="card-body">
                    <p class="card-text">Manage your patients and view their medical history.</p>
                </div>
            </div>
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <p class="card-text">Manage all users and their roles. Users can be removed / created here.</p>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Appointments</div>
                <div class="card-body">
                    <p class="card-text">Create your appointment with a doctor here.</p>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Calendar</div>
                <div class="card-body">
                    <p class="card-text">View your personal planning with appointments using your own personal calendar.</p>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <p class="card-text">Make changes to your personal information, update password, download your data and remove your account here.</p>
                </div>
            </div>
            @endif
            @if(Auth::user()->role == 'Doctor')
            <div class="card text-white bg-info mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Patients</div>
                <div class="card-body">
                    <p class="card-text">Manage your patients and view their medical history.</p>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Appointments</div>
                <div class="card-body">
                    <p class="card-text">Create your appointment with a doctor here.</p>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Calendar</div>
                <div class="card-body">
                    <p class="card-text">View your personal planning with appointments using your own personal calendar.</p>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <p class="card-text">Make changes to your personal information, update password, download your data and remove your account here.</p>
                </div>
            </div>
            @endif
            @if(Auth::user()->role == 'Patient')
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Appointments</div>
                <div class="card-body">
                    <p class="card-text">Create your appointment with a doctor here.</p>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Calendar</div>
                <div class="card-body">
                    <p class="card-text">View your personal planning with appointments using your own personal calendar.</p>
                </div>
            </div>
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem; margin: 0.5%;">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <p class="card-text">Make changes to your personal information, update password, download your data and remove your account here.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

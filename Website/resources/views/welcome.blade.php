<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        @livewireStyles

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    </head>
    <body>
        <nav id="welcomeNavigation" class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href=""><img src="{{ URL::to('/images/Logo6.png') }}" style="width: 200px;"></a></li>
                    </ul>
                    @if (Route::has('login'))
                        <ul class="navbar-nav ml-auto">
                            @auth
                                <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a></li>
                            @else
                                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                                @if (Route::has('register'))
                                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                                @endif
                            @endauth
                        </ul>
                    @endif
                </div>
            </div>
        </nav>

        <header class="welcomeHeader">
            <div class="container">
              <div class="welcomeHeaderTitle">Welcome To Appointment Manager</div>
              <div class="welcomeHeaderText text-uppercase">It's a pleasure to meet you</div>
            </div>
        </header>

        <div style="width: 100%; margin: 0 auto; padding: 3rem;">
            <div class="container">
                <div style="text-align: center; padding: 1rem;">
                    <h3>Why choose Appointment Manager?</h3>
                </div>
                <div class="card-deck">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-clock"></i> Time Saving</h5>
                            <p class="card-text">Your patients have the ability to book an appointment online. The patient does not have to call to the practice anymore.</p>
                        </div>
                    </div>
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-check-circle"></i> Comfort</h5>
                            <p class="card-text">As a doctor you can now focus on the treatment of your patients. The platform is easy to use by both patient and doctor.</p>
                        </div>
                    </div>
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-calendar2-check"></i> Controle</h5>
                            <p class="card-text">You have full control of the management of your appointments and patients.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="width: 100%; margin: 0 auto; padding: 3rem; background-color: #2946ff;">
            <section class="pricing">
                <div class="container">
                    <div style="text-align: center; padding: 1rem; color: white;">
                        <h3>Our lifetime packages</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div id="welcomePricingCard" class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">Basic</h5>
                                    <h5 id="welcomePricingPrice" class="card-price text-center" style="color: #108fc2">€800</h5>
                                    <hr>
                                    <ul class="fa-ul">
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> 50 Users</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Email Support</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Patient Management</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Appointments</li>
                                        <li class="text-muted"><span class="fa-li"><i class="bi bi-x-circle"></i></span> Personal Calender</li>
                                        <li class="text-muted"><span class="fa-li"><i class="bi bi-x-circle"></i></span> Chatbot</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div id="welcomePricingCard" class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
                                    <h5 id="welcomePricingPrice" class="card-price text-center"style="color: #108fc2">€1100</h5>
                                    <hr>
                                    <ul class="fa-ul">
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> 100 Users</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Phone / Email Support</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Patient Management</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Appointments</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Personal Calender</li>
                                        <li class="text-muted"><span class="fa-li"><i class="bi bi-x-circle"></i></span> Chatbot</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div id="welcomePricingCard" class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">Enterprise</h5>
                                    <h5 id="welcomePricingPrice" class="card-price text-center"style="color: #108fc2">€1500</h5>
                                    <hr>
                                    <ul class="fa-ul">
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Unlimited Users</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Priority Phone / Email Support</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Patient Management</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Appointments</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Personal Calender</li>
                                        <li><span class="fa-li"><i class="bi bi-check-circle"></i></span> Chatbot</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div style="width: 100%; margin: 0 auto; padding: 3rem;">
            <div class="container">
                <div style="text-align: center; padding: 1rem;">
                    <h3>Contact Us</h3>
                </div>
                
                <form>
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            <label for="inputName">Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Enter Name" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Enter Email" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="inputEmail">Phone <small>(Format: 0999 99 99 99)</small></label>
                            <input type="tel" class="form-control" id="inputEmail" pattern="[0-9]{4} [0-9]{2} [0-9]{2} [0-9]{2}" placeholder="Enter Phone" required>
                        </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-12 mb-6">
                        <label for="inputMessage">Message</label>
                        <textarea id="welcomeInputTextArea" class="form-control" id="inputMessage" rows="5" placeholder="Enter Message" required></textarea>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Send Message</button>
                </form>
            </div>
        </div>
    </body>
    <div class="flex justify-center mt-4 sm:items-center ">
        <?php
        if(!isset($_COOKIE['laravel_session_message'])){
        ?>
            <div id="welcomeOverlay">
                <div id="welcomeCookie" class="justify-content-center mt-10 h-100">
                    <div id="welcomeCookieCard" class="d-flex align-items-center card p-4">
                        <img src="{{ URL::to('/images/Logo6.png') }}" width="250px;">
                        <span class="mt-2">This website is only using necessary cookies.</span>
                        <span class="mt-2">For more information about our usage of cookies please read our       
                            <a id="welcomePrivacyLink" href="{{ route('privacy-policy')}}" target="_blank" class="ml-1 underline">Privacy Policy</a>.
                        </span>  
                        <br />
                        <button id="welcomeSetCookieMessage" type="button" class="btn btn-dark btn-sm">Accept</button> 
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="row">
        <button id="chatbotButton" type="button" class="btn btn-outline-info btn-sm"></button>
        <div id="chatbotChatWindow">
            <div class="card" id="chatbotCard" style="display: none;">
                <div id="chatbotHeader"><p>Appointment bot</p></div>
                <div id="chatbotCardBody" class="card-body">
                    <div class="ChatWindow"></div>
                </div>  
                <div class="card-footer d-flex flex-row justify-content-between">
                    <input type="text" class="form-control" id="UserMessageInput" placeholder="Enter your message">
                    <button class="btn btn-primary" id="UserMessageButton"><i class="bi bi-arrow-right-square-fill"></i></button>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-left"><img src="{{ URL::to('/images/Logo6.png') }}" style="width: 200px;"></div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-light btn-social mx-2"><i class="bi bi-facebook"></i></a>
                    <a class="btn btn-light btn-social mx-2"><i class="bi bi-github"></i></a>
                    <a class="btn btn-light btn-social mx-2"><i class="bi bi-linkedin"></i></a>
                </div>
                <div class="col-lg-4 text-lg-right">
                    <a id="welcomePrivacyLink" href="{{ route('privacy-policy')}}" target="_blank" class="ml-1 underline" style="color: white;">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>
</html>
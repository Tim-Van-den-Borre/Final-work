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
        @if (Route::has('login'))
            <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a id="welcomeLinks" href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                @else
                    <a id="welcomeLinks" href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                    @if (Route::has('register'))
                        <a id="welcomeLinks" href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register as patient</a>
                    @endif
                @endauth
            </div>
        @endif

        <header class="welcomeHeader">
            <div class="container">
              <div class="welcomeHeaderTitle">Welcome To Appointment Manager</div>
              <div class="welcomeHeaderText text-uppercase">It's a pleasure to meet you</div>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <h3 id="welcomeServices">Our Services</h3>
            </div>
            <div class="card-deck">
                <div id="welcomeCard" class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-clock"></i> Time Saving</h5>
                        <p class="card-text">Your patients have the ability to book an appointment online. The patient does not have to call to the practice anymore.</p>
                    </div>
                </div>
                <div id="welcomeCard" class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-check-circle"></i> Comfort</h5>
                        <p class="card-text">As a doctor you can now focus on the treatment of your patients. The platform is easy to use by both patient and doctor.</p>
                    </div>
                </div>
                <div id="welcomeCard" class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-calendar2-check"></i> Controle</h5>
                        <p class="card-text">You have full control of the management of your appointments and patients.</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="width: 80%; margin: 0 auto;">
            <div class="row">
                <h3 id="welcomePackages">Our Packages</h3>
            </div>
            <div class="card-deck" style="text-align: center;">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                  </div>
                </div>
            </div>
            <div style="text-align: center;">
                <p>Would you like more info on one of our packages? <br /> Please contact us using the contact form.</p>
            </div>
        </div>

        <div style="width: 80%; margin: 0 auto; padding-bottom: 3rem;">
            <div class="row">
                <h3 id="welcomeContact">Contact Us</h3>
            </div>
            <form>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="welcomeName">Name</label>
                                <input type="text" class="form-control" id="welcomeName">
                        </div>
                        <div class="form-group">
                            <label for="welcomeEmail">Email</label>
                                <input type="email" class="form-control" id="welcomeEmail">
                        </div>
                        <div class="form-group">
                            <label for="welcomeTelephone">Telephone</label>
                                <input type="tel" class="form-control" id="welcomeTelephone" pattern="[0-9]{4} [0-9]{2} [0-9]{2} [0-9]{2}">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="welcomeMessage">Message</label>
                                <textarea class="form-control" id="welcomeMessage" rows="8"></textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Send</button>
              </form>
        </div>
    </body>
    <footer class="footer py-4">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-4 text-lg-left">Copyright © Appointment-Manager 2021</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2"><i class="bi bi-facebook"></i></a>
                <a class="btn btn-dark btn-social mx-2"><i class="bi bi-github"></i></a>
                <a class="btn btn-dark btn-social mx-2"><i class="bi bi-linkedin"></i></a>
              </div>
            <div class="col-lg-4 text-lg-right">
                <a id="welcomePrivacyLink" href="{{ route('privacy-policy')}}" target="_blank" class="ml-1 underline">Privacy Policy</a>
            </div>
          </div>
        </div>
      </footer>

                <div class="flex justify-center mt-4 sm:items-center ">
            <?php
            if(!isset($_COOKIE['laravel_session_message'])){
            ?>
                <div id="welcomeOverlay">
                    <div id="welcomeCookie" class="justify-content-center mt-10 h-100">
                        <div id="welcomeCookieCard" class="d-flex align-items-center card p-4">
                            <img src="{{ URL::to('/images/Logo2.jpg') }}" width="50" style="border-radius: 50%;">
                            <span class="mt-2">This website is only using necessary cookies.</span>
                            <span class="mt-2">For more information about our usage of cookies please read our       
                                <a id="welcomePrivacyLink" href="{{ route('privacy-policy')}}" target="_blank" class="ml-1 underline">Privacy Policy</a>.
                            </span>  
                            <button id="welcomeSetCookieMessage" type="button" class="btn btn-dark btn-sm">Accept</button> 
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="row">
            <button id="chatbotButton" type="button" class="btn btn-outline-info btn-sm">Chat with us</button>
            <div id="chatbotChatWindow">
                <div class="card" id="chatbotCard" style="display: none;">
                    <div id="chatbotHeader"><p>Appointment Bot</p></div>
                    <div id="chatbotCardBody" class="card-body">
                        <div class="ChatWindow"></div>
                    </div>  
                    <div class="card-footer">
                        <input type="text" class="form-control" id="UserMessageInput" placeholder="Enter your message">
                    </div>
                </div>
            </div>
        </div>
</html>